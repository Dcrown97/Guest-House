<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
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
        //rooms booked today
        $bookings = Booking::with('room')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(15);
        // dd($bookings);

        //total rooms booked today count
        $bookings_count = Booking::whereDate('created_at', Carbon::today())->count();
        // dd($bookings_count);

        //total rooms booked today amount
        $bookings_amount = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        // dd($bookings_amount);

        //rooms booked yesterday
        $bookings_yesterday = Booking::with('room')->whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->paginate(15);
        // dd($bookings_yesterday);

        //total rooms booked yesterday count
        $bookings_yesterday_count = Booking::whereDate('created_at', Carbon::yesterday())->count();
        // dd($bookings_yesterday_count);

        //total rooms booked yesterday amount
        $bookings_yesterday_amount = Booking::whereDate('created_at', Carbon::yesterday())->sum('amount');
        // dd($bookings_yesterday_amount);

        //rooms booked this week
        $bookings_this_week = Booking::with('room')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at', 'desc')->paginate(15);
        // dd($bookings_this_week);

        //total rooms booked this week count
        $bookings_this_week_count = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        // dd($bookings_this_week_count);

        //total rooms booked this week amount
        $bookings_this_week_amount = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');

        //rooms booked all time
        $bookings_all_time = Booking::with('room')->orderBy('created_at', 'desc')->paginate(15);
        // dd($bookings_all_time);

        //total rooms booked all time count
        $bookings_all_time_count = Booking::count();
        // dd($bookings_all_time_count);

        //total rooms booked all time amount
        $bookings_all_time_amount = Booking::sum('amount');
        // dd($bookings_all_time_amount);

        return view('bookings_report', compact('bookings', 'bookings_count', 'bookings_amount', 'bookings_yesterday', 'bookings_yesterday_count', 'bookings_yesterday_amount', 'bookings_this_week', 'bookings_this_week_count', 'bookings_this_week_amount', 'bookings_all_time', 'bookings_all_time_count', 'bookings_all_time_amount'));

    }

}
