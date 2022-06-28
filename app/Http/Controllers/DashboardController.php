<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_rooms = Room::count();
        $available_rooms = Room::where('status', 'available')->count();
        $booked_rooms = Room::where('status', 'booked')->count();
        return view('dashboard', ['total_rooms' => $total_rooms, 'available_rooms' => $available_rooms, 'booked_rooms' => $booked_rooms]);
    }
}
