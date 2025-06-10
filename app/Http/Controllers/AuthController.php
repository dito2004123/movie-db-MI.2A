<?php
namespace App\http\controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;



class AuthController extends controller
{
    public function loginform()
    {
        return view('login');
    }

    public function login(Request $request) {
    $credentials = $request->validate(
    [
            'email' => 'required|email',
        'password' => 'required|min:3'
    ]
    );

    if (Auth::attempt($credentials)){
        $request->session()->regenerate();
        return redirect('/')->with('succes', 'login','Login Succesfully, Welcome'.
        Auth::user()->name);
    }

    return back()->withErrors(
        ['email' => 'Email Not Found'
    ]);

    }
}
