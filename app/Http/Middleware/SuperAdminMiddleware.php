<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // ✅ hanya role super admin yang bisa lewat
        if (Auth::check() && Auth::user()->role === 'super admin') {
            return $next($request);
        }

        // kalau bukan super admin, arahkan ke login
        return redirect('/masuk')->with('error', 'Akses ditolak, hanya super admin!');
    }
}
