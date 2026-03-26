<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::published()->ordered()->get();
        return view('pages.rooms.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        if (!$room->published) {
            abort(404);
        }
        return view('pages.rooms.show', compact('room'));
    }
}
