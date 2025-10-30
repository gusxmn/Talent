<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AccountSettingsController extends Controller
{
    /**
     * Menampilkan halaman pengaturan akun (Detail Login).
     */
    public function index()
    {
        // Pastikan pengguna sudah login sebelum mengakses halaman ini
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        return view('login_detail');
    }

    /**
     * Menampilkan halaman Kontak Saya.
     */
    public function contactIndex()
    {
        // Pastikan pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        // Data pengguna akan diakses langsung di view melalui Auth::user()
        return view('contact_detail');
    }

    /**
     * Menangani proses penggantian kata sandi.
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'new_password' => 'required|string|min:8|max:255',
            'confirm_password' => 'required|string|same:new_password',
        ], [
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi minimal 8 karakter.',
            'confirm_password.required' => 'Konfirmasi kata sandi wajib diisi.',
            'confirm_password.same' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
        ]);

        $user = Auth::user();
        
        // Cek apakah akun adalah akun Google (tidak punya password)
        if (is_null($user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return back()->with('success_password', 'Kata sandi berhasil dibuat untuk akun Google Anda.');
        }

        // 2. Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success_password', 'Kata sandi berhasil diperbarui.');
    }

    /**
     * Menangani proses pembaruan alamat email.
     */
    public function updateEmail(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'new_email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ], [
            'new_email.required' => 'Email baru wajib diisi.',
            'new_email.email' => 'Format email tidak valid.',
            'new_email.unique' => 'Email ini sudah digunakan oleh akun lain.',
        ]);

        $user = Auth::user();

        // 2. Update email
        $user->email = $request->new_email;
        $user->email_verified_at = null; // Set null karena email baru belum diverifikasi
        $user->save();

        return back()->with('success_email', 'Email berhasil diperbarui. Anda mungkin perlu memverifikasi email baru Anda.');
    }

    /**
     * Menangani proses pembaruan nomor WhatsApp.
     */
    public function updateWhatsapp(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            // ATURAN BARU:
            // 1. Maksimal 15 karakter.
            // 2. Hanya berisi angka (0-9) dan simbol plus (+).
            // 3. Harus diawali dengan '08' atau '+628' atau '8'
            'whatsapp' => [
                'required',
                'max:15',
                // Regex yang lebih fleksibel, menerima +628, 08, atau 8 di awal, dan minimal 10 digit (termasuk 08)
                'regex:/^(\+628|08|8)[0-9]{8,13}$/', 
            ],
        ], [
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 karakter.',
            'whatsapp.regex' => 'Format Nomor WhatsApp tidak valid. Masukkan format yang benar (cth: 0812xxxxxxxx, 812xxxxxxxx, atau +62812xxxxxxxx).',
        ]);

        $user = Auth::user();
        $whatsapp_input = $request->whatsapp;

        // 2. Bersihkan dan Standarisasi Nomor sebelum disimpan ke database
        // Jika diawali '08', hapus '0'
        if (substr($whatsapp_input, 0, 2) === '08') {
            $cleaned_whatsapp = substr($whatsapp_input, 1); // Menjadi 8xxxx
        } 
        // Jika diawali '+628', hapus '+62'
        elseif (substr($whatsapp_input, 0, 4) === '+628') {
            $cleaned_whatsapp = substr($whatsapp_input, 3); // Menjadi 8xxxx
        }
        // Jika sudah diawali '8' atau format lain yang valid, gunakan apa adanya
        else {
            $cleaned_whatsapp = $whatsapp_input;
        }

        // Simpan nomor yang sudah distandarisasi (tanpa +62 atau 0)
        $user->whatsapp = $cleaned_whatsapp;
        $user->save();

        return back()->with('success_whatsapp', 'Nomor WhatsApp berhasil diperbarui.');
    }
}