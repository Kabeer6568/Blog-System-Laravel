<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    //redirect to layouts/index
    public function create(){
        return view('layouts.register');
    }

    //register funtionality
    public function register(Request $request ){

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255|confirmed',
            'phone_num' => 'required|string|max:255',
        ]);

        unset($data['password_confirmation']);//remove from the data being send

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('blog.dashboard')->with('succcess' , "Registered");

    }

    public function dashboard(){

        $user = auth()->user();

        return view('layouts.dash' , compact('user'));
    }

    //show login page

    public function showLogin(){
        return view('layouts.index');
    }

// Login Funtionality
    public function login(Request $request){

        $request->validate([
            'login' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        $loginData = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = ([
            $loginData => $request->login,
            'password' => $request->password,
        ]);

        if (AUTH::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('blog.dashboard')->with('succcess' , "Logged In");
        }

        return back()->withErrors([
            'login' => 'Email/Username Or Paswword is invalid',
        ])->onlyOutput('login');

    }

    public function logout(Request $request){

        AUTH::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog.login')->with('succcess' , "Logged In");

    }

}
