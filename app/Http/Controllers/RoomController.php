<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function availableRooms()
    {
        $rooms = Room::where('is_available', true)->get();
        return response()->json($rooms);
    }
}
