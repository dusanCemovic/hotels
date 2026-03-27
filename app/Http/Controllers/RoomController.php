<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        // Show only published rooms with active translations
        $rooms = Room::published()->withActiveTranslations()->ordered()->get();
        return view('pages.rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        // If one room is only available in one language, for the other will redirect to main list
        if (!$room->published || !$room->hasActiveTranslation()) {
           return redirect()->route('rooms.index')->with('error', __('rooms.room-not-found'));
        }
        return view('pages.rooms.show', compact('room'));
    }
}
