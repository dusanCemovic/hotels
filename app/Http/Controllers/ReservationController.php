<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['room' => function ($q) {
            // Ensure translated attributes are loaded according to current locale
        }])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }
}
