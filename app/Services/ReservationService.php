<?php

namespace App\Services;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationService
{
    /**
     * Store a new room reservation.
     * @param array $data
     * @return Reservation|null
     *
     */
    public function storeRoom(array $data): ?Reservation
    {
        if (!$this->checkIfRoomIsAvailable($data['room_id'], $data['date_from'], $data['date_to'])) {
            return null;
        }

        return Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $data['room_id'],
            'date_from' => $data['date_from'],
            'date_to' => $data['date_to'],
            'name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /**
     * Simple check if a room is available. We can extend this to check when a room is available, add suggestion, and so on.
     * @param mixed $room_id
     * @param mixed $date_from
     * @param mixed $date_to
     * @return bool
     */
    private function checkIfRoomIsAvailable(mixed $room_id, mixed $date_from, mixed $date_to): bool
    {
        if ($room_id === null || $date_from === null || $date_to === null) {
            return false;
        }

        $exists = Reservation::where('room_id', $room_id)
            ->where(function ($query) use ($date_from, $date_to) {
                $query->where('date_from', '<', $date_to)
                    ->where('date_to', '>', $date_from);
            })
            ->exists();

        return !$exists;
    }
}
