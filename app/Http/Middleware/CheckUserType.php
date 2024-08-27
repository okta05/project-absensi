<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $type)
    {
        if (Auth::check() && $this->checkUserType($type)) {
            return $next($request);
        }
    
        return redirect('/home');
    }
    
    private function checkUserType($type)
    {
        switch ($type) {
            case 'kepsek':
                return Auth::user() instanceof \App\Models\Kepsek;
            case 'admin':
                return Auth::user() instanceof \App\Models\Admin;
            case 'guru':
                return Auth::user() instanceof \App\Models\Guru;
            case 'bk':
                return Auth::user() instanceof \App\Models\Bk;
            case 'wakel':
                return Auth::user() instanceof \App\Models\Wakel;
            case 'kurikulum':
                return Auth::user() instanceof \App\Models\Kurikulum;
            default:
                return false;
        }
    }
}
