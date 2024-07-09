<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    //
    public function postlogin(Request $request)
    {  
        $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } elseif (Auth::guard('kepsek')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } elseif (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }

    public function logout() {
        
        Auth::logout();
        return redirect()->Route('login');
    }
}
