<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException; 

class AuthController extends Controller
{
    public function registerProcess(Request $request)
    {
        // 1. Validasi Data Input dari form daftar.blade.php
        $request->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'lokasi' => 'required|string|max:255',     
            'whatsapp' => 'required|string|max:15',     
        ]);

        // 2. Gabungkan nama depan dan belakang menjadi satu kolom 'name'
        $fullName = $request->nama_depan . ' ' . $request->nama_belakang;

        // 3. Simpan User Baru ke database dengan role 'user'
        $user = User::create([
            'name' => $fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'lokasi' => $request->lokasi,     
            'whatsapp' => $request->whatsapp, 
            'role' => 'user',                
            'is_active' => true,
        ]);
        
        // 4. Otomatis Login setelah daftar
        Auth::login($user);

        // 5. PERUBAHAN: Redirect ke halaman utama ('/')
        return redirect('/')->with('success', 'Pendaftaran berhasil! Selamat datang.');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Simpan session login
            Auth::login($user);

            // Cek role dan arahkan ke dashboard admin/user
            if (in_array($user->role, ['super admin', 'admin', 'wawancara', 'pimpinan', 'testdev'])) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect('/'); // pengguna biasa (role 'user') akan diarahkan ke Home
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/masuk');
    }
}