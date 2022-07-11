<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
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
            return redirect()->route('rooms')->with('error', "Room is already $room->status");
        }

       if($request->isMethod('post')){

        //check if status is available

        // dd($request->all());
             if($room->status !== 'booked')
            {
                $request->validate([
                    'check_in' => 'required',
                    'check_out' => 'required',
                    'customer_name' => 'required',
                ]);

                //check if check in date is less than check out date
                if(Carbon::parse($request->check_in)->format('Y-m-d') >= Carbon::parse($request->check_out)->format('Y-m-d')){
                    Alert::error('Error', 'Check in date must be less than check out date');
                    return back()->with('error', 'Check in date must be less than check out date');
                }

                //check if room is reserved between check in and check out date
                $reservation = Reservation::where('room_id', $room->id)->get()->last();
                // dd($reservation);
                $booking = new Booking();
                $booking->user_id = Auth::user()->id;
                $booking->room_id = $room->id;
                $booking->check_in = $request->check_in;
                // $booking->check_out = $request->check_out;
                //check_out time must be 12noon of the selected check out date
                $booking->check_out = Carbon::parse($request->check_out)->format('Y-m-d') . ' 12:00:00';
                $booking->room_price = $request->price;
                $booking->amount = $request->amount;
                $booking->payment_mode = $request->mode;
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

// booking resevertion
    public function booking_reservation(Request $request, $id){
        // dd(base64_decode($id));
        if($request->status == 'booked'){
        $room = Booking::where('room_id',base64_decode($id))->with('room')->get()->last();
        if($request->isMethod('post')){
            
            $request->validate([
                'check_in' => 'required',
                'check_out' => 'required',
                'customer_name' => 'required',
            ]);
            // dd($room);
            // check if room is booked and check if the check out date is less than the selected check in date
            if($room->room->status == 'booked' && Carbon::parse($room->check_out) >
            Carbon::parse($request->check_in)){
                $max_date =  Carbon::parse($room->check_out)->format('Y-m-d');
                Alert::error('Error', "Check in date for reservation must be greater than $max_date because the room is already booked");
                return back()->with('error', "Check in date for reservation must be greater than $max_date because the room is already booked");
            }else{
                //check if check in date is less than check out date
            if(Carbon::parse($request->check_in) >= Carbon::parse($request->check_out)){
                Alert::error('Error', 'Check in date must be less than check out date');
                return back()->with('error', 'Check in date must be less than check out date');
            }

            // dd($request->all());
            $reserve = new Reservation();
                $reserve->user_id = Auth::user()->id;
                $reserve->room_id = $room->room->id;
                $reserve->check_in = $request->check_in;
                //check_out time must be 12noon of the selected check out date
                $reserve->check_out = Carbon::parse($request->check_out)->format('Y-m-d') . ' 12:00:00';
                $reserve->room_price = $request->price;
                $reserve->amount = $request->amount;
                $reserve->payment_mode = $request->mode;
                $reserve->days = $request->days;
                $reserve->customer_name = $request->customer_name;
                $reserve->customer_phone = $request->customer_phone;
                $saved = $reserve->save();
                if ($saved) {
                    $room = Room::find(base64_decode($id))->update(['status' => 'reserved']);
                    Alert::success('Success', 'Reservation successful');
                    return redirect()->route('rooms');
                } else {
                    Alert::error('Error', 'Reservation failed');
                    return back()->with('error', 'Reservation failed');
                }

            }
        }
        return view('reserve', ['room' => $room]);
           
        }else{
            $room = Room::find(base64_decode($id));
            // dd($room->status);
            //if room status is reserved, put a warning message to session
            if($room->status == 'reserved'){
                $reserve = Reservation::where('room_id', $room->id)->get()->last();
                // dd($reserve);
                Alert::warning('Warning', "Room is already reserved between $reserve->check_in and $reserve->check_out");
                Session::flash('warning', "Room is already reserved by $reserve->customer_name from $reserve->check_in to $reserve->check_out so please take note of this before choosing dates for this new reservation");
            }

             if($request->isMethod('post')){
            
            $request->validate([
                'check_in' => 'required',
                'check_out' => 'required',
                'customer_name' => 'required',
            ]);
            // dd($room);
            // check if room is booked and check if the check out date is less than the selected check in date
            if($room->status == 'booked' && Carbon::parse($room->check_out)>
            Carbon::parse($request->check_in)){
                $max_date =  Carbon::parse($room->check_out)->format('Y-m-d');
                Alert::error('Error', "Check in date for reservation must be greater than $max_date because the room is already booked");
                return back()->with('error', "Check in date for reservation must be greater than $max_date because the room is already booked
                because the room is already booked");
            }else{
                //check if check in date is less than check out date
            if(Carbon::parse($request->check_in) >= Carbon::parse($request->check_out)){
                Alert::error('Error', 'Check in date must be less than check out date');
                return back()->with('error', 'Check in date must be less than check out date');
            }


            // dd($request->all());
            $reserve = new Reservation();
                $reserve->user_id = Auth::user()->id;
                $reserve->room_id = $room->id;
                $reserve->check_in = $request->check_in;
                //check_out time must be 12noon of the selected check out date
                $reserve->check_out = Carbon::parse($request->check_out)->format('Y-m-d') . ' 12:00:00';
                $reserve->room_price = $request->price;
                $reserve->amount = $request->amount;
                $reserve->payment_mode = $request->mode;
                $reserve->days = $request->days;
                $reserve->customer_name = $request->customer_name;
                $reserve->customer_phone = $request->customer_phone;
                $saved = $reserve->save();
                if ($saved) {
                    $room = Room::find(base64_decode($id))->update(['status' => 'reserved']);
                    Alert::success('Success', 'Reservation successful');
                    return redirect()->route('rooms');
                } else {
                    Alert::error('Error', 'Reservation failed');
                    return back()->with('error', 'Reservation failed');
                }

            }
        }
        return view('reserve', ['room' => $room]);
            
        }
       
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
