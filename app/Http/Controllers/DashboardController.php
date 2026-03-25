<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard with their latest reservation.
     */
    public function index(): View
    {
        $lastReservation = Reservation::where('user_id', Auth::id())
            ->with('room')
            ->latest()
            ->first();

        return view('dashboard', compact('lastReservation'));
    }
}
