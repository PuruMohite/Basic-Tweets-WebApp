<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //validate the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //attempt the login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            //regen session for security 
            $request->session()->regenerate();

            //redirect to intended page or home
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        //if login fails, redirect back with error
        return back()->withErrors(['email' => 'The provided credentials do not match our records.'])->onlyInput('email');
    }
}
