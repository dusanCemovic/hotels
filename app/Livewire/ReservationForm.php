<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationForm extends Component
{
    public $room;
    public $step = 1;
    public $isSuccess = false;

    // Step 1 data
    public $date_from;
    public $date_to;

    // Step 2 data
    public $name;
    public $email;

    public function mount($roomId)
    {
        try {
            $this->room = Room::findOrFail($roomId);
        } catch (\Exception $e) {
            return redirect()->route('rooms.index')->with('error', __('rooms.room-not-found'));
        }

        if (Auth::check()) {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }

    public function submit(): void
    {
        if ($this->step === 1) {
            $this->validateDates();
        } else if ($this->step === 2) {
            $this->makeReservation();
        }
        // else continue

    }

    public function render()
    {
        return view('livewire.reservation-form');
    }

    /**
     * STEP 1
     * Validate reservation dates
     * @return void
     */
    private function validateDates(): void
    {
        $this->validate([
            'date_from' => 'required|date|after_or_equal:today',
            'date_to' => 'required|date|after:date_from',
        ]);

        $this->step = 2;
    }

    /**
     * STEP 2
     * Check and make reservation based on params
     * @return void
     */
    private function makeReservation()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'room_id' => $this->room->id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->isSuccess = true;
    }
}
