<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FoodOrder;
use App\Models\OrderDrink;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //middleware to check if user is logged in
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $total_rooms = Room::count();
        $available_rooms = Room::where('status', 'available')->count();
        $booked_rooms = Room::where('status', 'booked')->count();
        //total sales 
        $total_bookings = Booking::sum('amount');
        $total_amount_all = OrderDrink::with('drink')->sum('ordered_total_price');
        $foodReports_all_amount = FoodOrder::sum('ordered_food_price');
        $total_sales = $total_bookings + $total_amount_all + $foodReports_all_amount;
        
        // dd($total_sales);

        //todays bookings sales
        $today_sales = Booking::whereDate('created_at', date('Y-m-d'))->sum('amount');
     


        // dd($today_sales);

        //todays food sales
        $today_food_sales = FoodOrder::whereDate('created_at', date('Y-m-d'))->sum('ordered_food_price');

        //todays drink sales
        $today_drink_sales = OrderDrink::whereDate('created_at', date('Y-m-d'))->sum('ordered_drink_price');

        //total sales today
        $total_today_sales = $today_sales + $today_food_sales + $today_drink_sales;

        return view('dashboard', ['total_rooms' => $total_rooms, 'available_rooms' => $available_rooms, 'booked_rooms' => $booked_rooms, 'total_sales' => $total_sales, 'today_sales' => $today_sales, 'today_food_sales' => $today_food_sales, 'today_drink_sales' => $today_drink_sales, 'total_today_sales' => $total_today_sales]);
    }

    
}
