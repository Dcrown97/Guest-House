<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use App\Models\Food;
use App\Models\FoodOrder;
use App\Models\OrderDrink;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    public function Food()
    {
        $Foods = Food::all();

        // dd('food', $Foods);

        return view('food', compact('Foods'));
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

        $Drinks = Drink::all();

        return view('drinks', compact('Drinks'));
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
        ]);

        $OrderedDrinks = new OrderDrink();

        //add drinks
        if ($request->isMethod('post')) {
            // dd($ request->all());
            $request->validate([
                'drink_id' => 'required',
                'ordered_drink_price' => 'required',
                'ordered_drink_quantity' => 'required',
            ]);

            $OrderedDrinks->drink_id = $request->drink_id;
            $OrderedDrinks->ordered_drink_price = $request->ordered_drink_price;
            $OrderedDrinks->ordered_drink_quantity = $request->ordered_drink_quantity;
            $saved = $OrderedDrinks->save();
            if ($saved) {
                return redirect('/drinks')->with('success', 'Drink Ordered Successfully');
            } else {
                return redirect('/drinks')->with('error', 'Drink Order Failed');
            }
        }

        return view('drinks');
    }

    public function getDrinkPrice(Request $request)
    {
        // dd($request->drink_id);
        if ($request->drink_id !== null) {
            $DrinkPrice = Drink::find($request->drink_id);
            // dd($DrinkPrice);
            echo json_encode($DrinkPrice->drink_price);
        } else {
            echo json_decode('No Drink Price Selected');
        }
    }
}
