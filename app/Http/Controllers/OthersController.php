<?php

namespace App\Http\Controllers;

use App\Models\Other;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OthersController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $others = Other::paginate(10);
        // dd($others);

        if($request->isMethod('post')){
            // dd($request->all());
            $request->validate([
                'name' => 'required',
            ]);

            $other = new Other();
            $other->name = $request->name;
            $other->price = $request->price;
            $other->info = $request->info;
            $saved = $other->save();

            if($saved){
                Alert::success('Success', 'Added successfully');
                return back()->with('success', 'Added successfully');
            } else {
                Alert::error('Error', 'Failed to add');
                return back()->with('error', 'Failed to add');
            }
        }

        return view('others', ['others' => $others]);

    }
}
