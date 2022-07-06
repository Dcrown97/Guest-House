<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    //Note: Booking reservation method is in BookingController.php

    //middleware to check if user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }

    //get all reservations arranged by most recent first
    public function index()
    {
        $reservations = Reservation::with('room')->orderBy('created_at', 'desc')->paginate(10);
        return view('reservations', ['reservations' => $reservations]);
    }

}
