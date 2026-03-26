<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Services\ReservationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected ReservationService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ReservationService();
    }

    public function test_can_store_room_when_available()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // We create a room. Since it's a Twill model, we just need the base record for this test.
        $room = Room::create(['published' => true]);

        $data = [
            'room_id' => $room->id,
            'date_from' => '2026-04-01',
            'date_to' => '2026-04-05',
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $reservation = $this->service->storeRoom($data);

        $this->assertNotNull($reservation);
        $this->assertEquals($room->id, $reservation->room_id);
        $this->assertDatabaseHas('reservations', [
            'room_id' => $room->id,
            'date_from' => '2026-04-01',
            'date_to' => '2026-04-05',
        ]);
    }

    public function test_cannot_store_room_when_overlapping()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $room = Room::create(['published' => true]);

        // Existing reservation: April 5th to April 10th
        Reservation::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'date_from' => '2026-04-05',
            'date_to' => '2026-04-10',
            'name' => 'Existing',
            'email' => 'existing@example.com',
        ]);

        // Scenario 1: Exactly the same dates (April 5-10)
        $this->assertNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-05',
            'date_to' => '2026-04-10',
            'name' => 'Overlap 1',
            'email' => 'overlap1@example.com',
        ]));

        // Scenario 2: Starts before, ends during (April 1-7)
        $this->assertNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-01',
            'date_to' => '2026-04-07',
            'name' => 'Overlap 2',
            'email' => 'overlap2@example.com',
        ]));

        // Scenario 3: Starts during, ends after (April 8-15)
        $this->assertNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-08',
            'date_to' => '2026-04-15',
            'name' => 'Overlap 3',
            'email' => 'overlap3@example.com',
        ]));

        // Scenario 4: Completely inside (April 6-9)
        $this->assertNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-06',
            'date_to' => '2026-04-09',
            'name' => 'Overlap 4',
            'email' => 'overlap4@example.com',
        ]));

        // Scenario 5: Completely covers (April 1-20)
        $this->assertNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-01',
            'date_to' => '2026-04-20',
            'name' => 'Overlap 5',
            'email' => 'overlap5@example.com',
        ]));

        // Scenario 6: Completely after (April 15-20)
        $this->assertNotNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-15',
            'date_to' => '2026-04-20',
            'name' => 'Work 5',
            'email' => 'overlap5@example.com',
        ]));
    }

    public function test_can_store_room_on_adjacent_dates()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $room = Room::create(['published' => true]);

        // Existing reservation: April 5th to April 10th
        Reservation::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'date_from' => '2026-04-05',
            'date_to' => '2026-04-10',
            'name' => 'Existing',
            'email' => 'existing@example.com',
        ]);

        // Can book until April 5th (ends when the next starts)
        $this->assertNotNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-01',
            'date_to' => '2026-04-05',
            'name' => 'Adjacent Before',
            'email' => 'before@example.com',
        ]));

        // Can book from April 10th (starts when the previous ends)
        $this->assertNotNull($this->service->storeRoom([
            'room_id' => $room->id,
            'date_from' => '2026-04-10',
            'date_to' => '2026-04-15',
            'name' => 'Adjacent After',
            'email' => 'after@example.com',
        ]));
    }
}
