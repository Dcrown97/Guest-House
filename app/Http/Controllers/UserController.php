<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function SignUp(Request $request)
    {
        //redirect to dashboard if user is already logged in
        if (Auth::check()) {
            return redirect()->route('/');
        }

        //admin registration
        if ($request->isMethod('post')) {
            // dd($ request->all());
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'password_confirmation' => 'required|same:password',
            ]);

            $user = new User();

            //admin registration
            if ($request->isMethod('post')) {
                // dd($ request->all());
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
                    'password_confirmation' => 'required|same:password',
                ]);

                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $saved = $user->save();
                if ($saved) {
                    return redirect('/login')->with('success', 'Registration Successful');
                } else {
                    return redirect('/signup')->with('error', 'Registration Failed');
                }
            }
        }
        return view('signUp');
    }

    public function Login(Request $request)
    {

        //redirect to dashboard if user is already logged in
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $data = $request->all();
            try {
                $user = User::where('email', $data['email'])->first();
            } catch (\Exception $e) {
                Alert::error('Server Error', 'Error');
                return redirect()->back()->with('error', 'Server Error, Please make sure that Xampp is running');
            }
            if ($user) {
                if (Hash::check($data['password'], $user->password)) {
                    Auth::login($user);
                    $request->session()->put('user', $user);
                    return redirect()->route('dashboard')->with('success','Logged In Successfully');
                } else {
                    return redirect()->back()->with('error', 'Invalid password');
                }
            } else {

                return redirect()->back()->with('error', 'Invalid email');
            }
        }

        return view('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('login');
    }

}
