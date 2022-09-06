<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except'=>['logout']]);
        $this->middleware('auth', ['only'=>['logout']]);
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email'=>$validated['email'], 'password'=>$validated['password']])) {
            return response()->json(['Status'=>'success', 'message'=>'Login Successful']);
        }
        return response()->json(['Status'=>'error', 'message'=>'Invalid Credentials!']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
