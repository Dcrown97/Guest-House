<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\OrderDrink;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    //middleware to check if user is logged in

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function Food()
    {
        $foods = Food::paginate(10);

        // dd('food', $Foods);

        return view('food', compact('foods'));
    }

    public function addFood(Request $request)
    {
        //add food
        if ($request->isMethod('post')) {
            // dd($ request->all());
            $request->validate([
                'food_name' => 'required',
                'food_price' => 'required',
            ]);

            $Foods = new Food();

            //add food
            if ($request->isMethod('post')) {
                // dd($ request->all());
                $request->validate([
                    'food_name' => 'required',
                    'food_price' => 'required',
                ]);

                $Foods->food_name = $request->food_name;
                $Foods->food_price = $request->food_price;
                $saved = $Foods->save();
                if ($saved) {
                    return redirect('/food')->with('success', 'Food Added Successfully');
                } else {
                    return redirect('/food')->with('error', 'Food Add Failed');
                }
            }
        }

        return view('food');
    }

    public function orderFood(Request $request)
    {
        //Order food
        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'food_id' => 'required',
                'ordered_food_price' => 'required',
            ]);

            $OrderedFoods = new FoodOrder();

            //Order food
            if ($request->isMethod('post')) {
                // dd($request->all());
                $request->validate([
                    'food_id' => 'required',
                    'ordered_food_price' => 'required',
                ]);

                $OrderedFoods->food_id = $request->food_id;
                $OrderedFoods->ordered_food_price = $request->ordered_food_price;
                $OrderedFoods->payment_mode = $request->mode;
                $saved = $OrderedFoods->save();
                if ($saved) {
                    return redirect('/food')->with('success', 'Food Ordered Successfully');
                } else {
                    return redirect('/food')->with('error', 'Food Order Failed');
                }
            }
        }

        return view('food');
    }


    public function foodReport () {

        // $foodReports = FoodOrder::all();
        //food sold today
        $foodReports = FoodOrder::with('food')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(15);

        //total food sold today amount
        $foodReports_amount = FoodOrder::whereDate('created_at', Carbon::today())->sum('ordered_food_price');
        // dd($foodReports_amount);

        //food sold yesterday
        $foodReports_yesterday = FoodOrder::with('food')->whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->paginate(15);

        //total food sold yesterday amount
        $foodReports_yesterday_amount = FoodOrder::whereDate('created_at', Carbon::yesterday())->sum('ordered_food_price');
        // dd($foodReports_yesterday_amount);

        //food sold this week
        $foodReports_week = FoodOrder::with('food')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at', 'desc')->paginate(15);

        //total food sold this week amount
        $foodReports_week_amount = FoodOrder::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('ordered_food_price');

        //food sold all time
        $foodReports_all = FoodOrder::with('food')->orderBy('created_at', 'desc')->paginate(15);

        //total food sold all time amount
        $foodReports_all_amount = FoodOrder::sum('ordered_food_price');

        return view('foodReport', compact('foodReports', 'foodReports_amount', 'foodReports_yesterday', 'foodReports_yesterday_amount', 'foodReports_week', 'foodReports_week_amount', 'foodReports_all', 'foodReports_all_amount'));
    }


    public function getFoodPrice(Request $request)
    {
        // dd($request->food_id);
        if ($request->food_id !== null) {
            $FoodPrice = Food::find($request->food_id);
            // dd($FoodPrice);
            echo json_encode($FoodPrice->food_price);
        } else {
            echo json_decode('No Food Price Selected');
        }
    }

    public function Drinks()
    {

        $drinks = Drink::paginate(15);

        return view('drinks', compact('drinks'));
    }

    public function addDrinks(Request $request)
    {

        //add drinks
        if ($request->isMethod('post')) {
            // dd($ request->all());
            $request->validate([
                'drink_name' => 'required',
                'num_of_drink' => 'required',
                'drink_price' => 'required',
            ]);

            $Drinks = new Drink();

            //add drinks
            if ($request->isMethod('post')) {
                // dd($ request->all());
                $request->validate([
                    'drink_name' => 'required',
                    'num_of_drink' => 'required',
                    'drink_price' => 'required',
                ]);

                $Drinks->drink_name = $request->drink_name;
                $Drinks->num_of_drink = $request->num_of_drink;
                $Drinks->drink_price = $request->drink_price;
                $saved = $Drinks->save();
                if ($saved) {
                    return redirect('/drinks')->with('success', 'Drink Added Successfully');
                } else {
                    return redirect('/drinks')->with('error', 'Drink Add Failed');
                }
            }
        }

        return view('drinks');
    }

    public function orderDrink(Request $request)
    {

        // dd($ request->all());
        $request->validate([
            'drink_id' => 'required',
            'ordered_drink_price' => 'required',
            'ordered_drink_quantity' => 'required',
            'ordered_total_price' => 'required',
        ]);

        $OrderedDrinks = new OrderDrink();

        //add drinks
        if ($request->isMethod('post')) {
            // dd($ request->all());
            $request->validate([
                'drink_id' => 'required',
                'ordered_drink_price' => 'required',
                'ordered_drink_quantity' => 'required',
                'ordered_total_price' => 'required',
            ]);

            $OrderedDrinks->drink_id = $request->drink_id;
            $OrderedDrinks->ordered_drink_price = $request->ordered_drink_price;
            $OrderedDrinks->payment_mode = $request->mode;
            $OrderedDrinks->ordered_drink_quantity = $request->ordered_drink_quantity;
            $OrderedDrinks->ordered_total_price = $request->ordered_total_price;
            $saved = $OrderedDrinks->save();
            if ($saved) {

                //update drink quantity on drink table
                $drink = Drink::find($request->drink_id);
                $drink->num_of_drink = $drink->num_of_drink - $request->ordered_drink_quantity;
                $drink->save();

                return redirect('/drinks')->with('success', 'Drink Ordered Successfully');
            } else {
                return redirect('/drinks')->with('error', 'Drink Order Failed');
            }
        }

        return view('drinks');
    }

    public function drinksReport () {
       //drinks sold today
        $drinks = OrderDrink::with('drink')->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(15);
        //get total drinks sold today and total price
        $total_qty_today = OrderDrink::with('drink')->whereDate('created_at', Carbon::today())->sum('ordered_drink_quantity');
        $total_amount_today = OrderDrink::with('drink')->whereDate('created_at', Carbon::today())->sum('ordered_total_price');

        //drinks sold yesterday
        $drinksYesterday = OrderDrink::with('drink')->whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->paginate(15);
        //get total drinks sold yesterday and total price
        $total_qty_yesterday = OrderDrink::with('drink')->whereDate('created_at', Carbon::yesterday())->sum('ordered_drink_quantity');
        $total_amount_yesterday = OrderDrink::with('drink')->whereDate('created_at', Carbon::yesterday())->sum('ordered_total_price');

        //drinks sold this week
        $drinksWeek = OrderDrink::with('drink')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->orderBy('created_at', 'desc')->paginate(15);
        //get total drinks sold this week and total price
        $total_qty_week = OrderDrink::with('drink')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('ordered_drink_quantity');
        $total_amount_week = OrderDrink::with('drink')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('ordered_total_price');

        //all drinks sold
        $drinksAll = OrderDrink::with('drink')->orderBy('created_at', 'desc')->paginate(15);
        //get total drinks sold and total price
        $total_qty_all = OrderDrink::with('drink')->sum('ordered_drink_quantity');
        $total_amount_all = OrderDrink::with('drink')->sum('ordered_total_price');
        // dd($drinks);

        return view('drinksReport', compact('drinks','drinksYesterday','drinksWeek','drinksAll','total_qty_today','total_amount_today','total_qty_yesterday','total_amount_yesterday','total_qty_week','total_amount_week','total_qty_all','total_amount_all'));
    }

    public function getDrinkPrice(Request $request)
    {
        // dd($request->drink_id);
        if ($request->drink_id !== null) {
            $DrinkPrice = Drink::find($request->drink_id);

            //price and quantity of drink
            echo json_encode(['price' => $DrinkPrice->drink_price, 'quantity' => $DrinkPrice->num_of_drink]);
           
        } else {
            echo json_decode('No Drink Price Selected');
        }
    }

    //update drinks records
    public function updateDrink(Request $request)
    {
        $drink = Drink::find($request->drink_id);
        if($request->isMethod('post')){
            // dd($request->all());
            // dd($drink);
        $request->validate([
            'drink_name' => 'required',
            'num_of_drink' => 'required',
            'drink_price' => 'required',
        ]);
        $drink->drink_name = $request->drink_name;
        $drink->num_of_drink = $request->num_of_drink;
        $drink->drink_price = $request->drink_price;
        $saved = $drink->save();
        if ($saved) {
            return redirect('/drinks')->with('success', 'Drink Updated Successfully');
        } else {
            return redirect('/drinks')->with('error', 'Drink Update Failed');
        }
        }
        // return view('drinks', compact('drink'));
    }

    //update number of drinks and price in drink table
    public function addMoreDrinks(Request $request)
    {
        $drink = Drink::find($request->drink_id);
        if($request->isMethod('post')){
            // dd($request->all());
            // dd($drink);
        $request->validate([
            'num_of_drink' => 'required',
            'drink_price' => 'required',
        ]);
        $drink->num_of_drink = $request->num_of_drink + $drink->num_of_drink;
        $drink->drink_price = $request->drink_price;
        $saved = $drink->save();
        if ($saved) {
            return redirect('/drinks')->with('success', 'More drinks added Successfully');
        } else {
            return redirect('/drinks')->with('error', 'Drink Update Failed');
        }
        }
        // return view('drinks', compact('drink'));
    }

//delete drinks records
    public function deleteDrink(Request $request, $id)
    {
        // dd($request->all());
        $drink = Drink::find(base64_decode($id));
        if($drink){
            $saved = $drink->delete();
        if ($saved) {
            return redirect('/drinks')->with('success', 'Drink Deleted Successfully');
        } else {
            return redirect('/drinks')->with('error', 'Drink Delete Failed');
        }
        }else{
            return redirect('/drinks')->with('error', 'Something went wrong');
        }
    }

    //update food records
    public function editFood(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'food_name' => 'required',
            'food_price' => 'required',
        ]);
        $food = Food::find($request->food_id);
        if($food){
            $food->food_name = $request->food_name;
        $food->food_price = $request->food_price;
        $saved = $food->save();
        if ($saved) {
            return redirect('/food')->with('success', 'Food Updated Successfully');
        } else {
            return redirect('/food')->with('error', 'Food Update Failed');
        }
        }else{
            return redirect('/food')->with('error', 'Something went wrong');
        }
        
    }

    //delete food records
    public function deleteFood(Request $request, $id)
    {
        // dd($request->all());
        $food = Food::find(base64_decode($id));
       if($food){
         $saved = $food->delete();
        if ($saved) {
            return redirect('/food')->with('success', 'Food Deleted Successfully');
        } else {
            return redirect('/food')->with('error', 'Food Delete Failed');
        }
       }else{
           return redirect('/food')->with('error', 'Something went wrong');
       }
    }
}
