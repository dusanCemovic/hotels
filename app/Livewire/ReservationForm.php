<?php

namespace App\Livewire;

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

    public function mount($room)
    {
        $this->room = $room;
        if (Auth::check()) {
            $this->name = Auth::user()->name;
            $this->email = Auth::user()->email;
        }
    }

    public function nextStep()
    {
        $this->validate([
            'date_from' => 'required|date|after_or_equal:today',
            'date_to' => 'required|date|after:date_from',
        ]);

        $this->step = 2;
    }

    public function submit()
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

    public function render()
    {
        return view('livewire.reservation-form');
    }
}
