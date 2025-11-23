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

    public function showUpdate(){
        $user = auth()->user();
        return view('layouts.edit' , ['user' => $user]);

    }

    public function update(Request $request){

        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . auth()->id(),//Get logged-in user's ID
            'password' => 'nullable|string|max:255',
            'phone_num' => 'nullable|string|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();//Get logged-in user object

        if($request->filled('name')){
            $user['name'] = $data['name'];
        }
        if($request->filled('email')){
            $user['email'] = $data['email'];
        }
        if($request->filled('password')){
            $user['password'] = bcrypt($data['password']);
        }
        if($request->filled('phone_num')){
            $user['phone_num'] = $data['phone_num'];
        }

        if ($request->hasFile('profile_img')) {
            
            if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
                Storage::disk('public')->delete($user->profile_img);
            }

            $path = $request->file('profile_img')->store('profiles' , 'public');
            $user->profile_img = $path;

        }

        $user->save();

        return redirect()->route('blog.dashboard')->with('succcess' , "Updated");

    }

}
