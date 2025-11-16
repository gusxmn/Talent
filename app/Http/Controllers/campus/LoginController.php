<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Campus;

class LoginController extends Controller
{
    /**
     * Menampilkan form login kampus
     */
    public function showLoginForm()
    {
        return view('campus_login');
    }

    /**
     * Proses login kampus
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba melakukan login
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('campus')->attempt($credentials)) {
            // Cek status aktif kampus
            $campus = Auth::guard('campus')->user();
            
            if (!$campus->is_active) {
                Auth::guard('campus')->logout();
                return back()->withErrors([
                    'email' => 'Akun kampus Anda tidak aktif. Silakan hubungi administrator.',
                ])->withInput();
            }

            // Regenerate session untuk keamanan
            $request->session()->regenerate();
            
            // Redirect ke dashboard kampus
            return redirect()->intended(route('campus.dashboard'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    /**
     * Logout kampus
     */
    public function logout(Request $request)
    {
        Auth::guard('campus')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // DIUBAH: Redirect ke halaman login kampus, bukan ke halaman utama
        return redirect()->route('campus.login')->with('info', 'Anda telah berhasil keluar dari akun kampus.');
    }

}