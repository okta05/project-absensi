<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        
      // Logout from all guards
      $guards = ['web', 'kepsek', 'admin', 'kurikulum', 'bk', 'wakel', 'guru'];
      foreach ($guards as $guard) {
          if (Auth::guard($guard)->check()) {
              Auth::guard($guard)->logout();
          }
      }

      // Clear session
      Session::flush();

      return redirect()->route('login');
    }
}
