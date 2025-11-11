<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCompany
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah sudah login sebagai perusahaan
        if (!Auth::guard('company')->check()) {
            return redirect()->route('company.login');
        }

        return $next($request);
    }
}
