<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(auth()->check('user')){
            return redirect()->route('home');
        }
        return view('login');
    }
    public function user_login(Request $request)
    {
        // print_r($request->all());
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->with('msg', 'Incorrect Credentials');
        }
    }
    public function register(Request $request)
    {
        return view('register');
    }

    public function user_create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        
        User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('login');
    }
        public function logout(Request $request) {
            Auth::logout(); 
        
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            return redirect()->route('login'); 
        }
    
}
