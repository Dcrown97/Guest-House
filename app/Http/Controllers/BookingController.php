<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BookingController extends Controller
{
    public function book(Request $request , $id){
        $room = Room::find(base64_decode($id));

       if($request->isMethod('post')){
        // dd($request->all());
              $request->validate([
                'check_in' => 'required',
                'check_out' => 'required',
              ]);
              $booking = new Booking();
              $booking->user_id = Auth::user()->id;
              $booking->room_id = $room->id;
              $booking->check_in = $request->check_in;
              $booking->check_out = $request->check_out;
              $booking->room_price = $request->price;
              $booking->amount = $request->amount;
              $booking->days = $request->days;
            //   $booking->status = 'pending';
              $saved = $booking->save();
              if($saved){
        $room = Room::find(base64_decode($id))->update(['status' => 'booked']);
                Alert::success('Success', 'Booking successful');
                return redirect()->route('rooms');
              }else{
                Alert::error('Error', 'Booking failed');
                return back()->with('error', 'Booking failed');
              }
       }

       return view('book', ['room' => $room]);
    }


    public function bookingsReport(){
        $bookings = Booking::with('room')->get();
        // dd($bookings);
        return view('bookings_report', ['bookings' => $bookings]);
    }
}
