<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    
    //middleware to check if user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function book(Request $request , $id){
        $room = Room::find(base64_decode($id));
        if ($room->status == 'booked'){
            return redirect()->route('rooms')->with('error', 'Room is already booked');
        }

       if($request->isMethod('post')){

        //check if status is available

        // dd($request->all());
             if($room->status == 'available')
            {
                $request->validate([
                    'check_in' => 'required',
                    'check_out' => 'required',
                    'customer_name' => 'required',
                ]);
                $booking = new Booking();
                $booking->user_id = Auth::user()->id;
                $booking->room_id = $room->id;
                $booking->check_in = $request->check_in;
                $booking->check_out = $request->check_out;
                $booking->room_price = $request->price;
                $booking->amount = $request->amount;
                $booking->days = $request->days;
                $booking->customer_name = $request->customer_name;
                $booking->customer_phone = $request->customer_phone;
                //   $booking->status = 'pending';
                $saved = $booking->save();
                if ($saved) {
                    $room = Room::find(base64_decode($id))->update(['status' => 'booked']);
                    Alert::success('Success', 'Booking successful');
                    return redirect()->route('rooms');
                } else {
                    Alert::error('Error', 'Booking failed');
                    return back()->with('error', 'Booking failed');
                }
            }else{
                Alert::error('Error', 'Room is not available');
                return back()->with('error', 'Room is not available');
            }
       }

       return view('book', ['room' => $room]);
    }


    public function bookingsReport(){
        $bookings = Booking::with('room')->orderBy('created_at', 'desc')->get();
        // dd($bookings);
        return view('bookings_report', ['bookings' => $bookings]);
    }

}
