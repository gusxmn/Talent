<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * Tampilkan form login perusahaan
     */
    public function showLoginForm()
    {
        return view('company_login');
    }

    /**
     * Proses login perusahaan
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        Log::info('Percobaan login perusahaan', $credentials); // 🔧 tambahan debug

        if (Auth::guard('company')->attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('Login perusahaan berhasil', ['user' => Auth::guard('company')->user()]); // 🔧 tambahan debug
            return redirect()->route('company.dashboard')
                ->with('login_success', 'Selamat datang kembali di dashboard perusahaan!');
        }

        Log::warning('Login perusahaan gagal', ['email' => $request->email]); // 🔧 tambahan debug

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    /**
     * Logout perusahaan
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login')->with('info', 'Anda telah keluar dari akun perusahaan.');
    }
}