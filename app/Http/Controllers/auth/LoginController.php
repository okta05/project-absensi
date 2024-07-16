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
        } elseif (Auth::guard('kurikulum')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } elseif (Auth::guard('bk')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } elseif (Auth::guard('wakel')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } elseif (Auth::guard('guru')->attempt($credentials)) {
            return redirect()->route('dashboard');
        }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }

    public function logout() {
        
        if (Auth::guard('kepsek')->check()){
            Auth::guard('kepsek')->logout();
        } elseif(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        } elseif(Auth::guard('kurikulum')->check()){
            Auth::guard('kurikulum')->logout();
        } elseif(Auth::guard('bk')->check()){
            Auth::guard('bk')->logout();
        } elseif(Auth::guard('wakel')->check()){
            Auth::guard('wakel')->logout();
        } elseif(Auth::guard('guru')->check()){
            Auth::guard('guru')->logout();
        } elseif(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }
        return redirect('/login');
    }
}
