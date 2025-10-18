<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class WawancaraMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect('/masuk')->with('error', 'Anda harus login untuk mengakses halaman ini.');
        }

        // 2. Cek apakah role pengguna adalah 'wawancara'
        // Jika peran pengguna SAMA dengan 'wawancara', maka izinkan akses.
        if (Auth::user()->role === 'wawancara') {
            return $next($request);
        }

        // 3. Jika peran tidak cocok, alihkan dan berikan pesan error.
        return redirect('/masuk')->with('error', 'Akses ditolak. Hanya pengguna dengan peran Wawancara yang diizinkan.');
    }
}
