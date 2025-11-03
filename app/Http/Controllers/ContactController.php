<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log

class ContactController extends Controller
{
    /**
     * Menampilkan halaman formulir kontak.
     */
    public function index()
    {
        // View yang berisi form kontak Anda
        return view('contact_us'); 
    }

    /**
     * Menyimpan pesan kontak yang baru dikirim ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Data - Nama kolom SAMA dengan di migrasi/model
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ], [
            'nama.required' => 'Kolom Nama Anda wajib diisi.',
            'email.required' => 'Kolom Alamat Email wajib diisi.',
            'email.email' => 'Format Email tidak valid.',
            'pesan.required' => 'Kolom Pesan wajib diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // 2. Simpan Data ke Database
        try {
            Contact::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'subjek' => $request->subjek,
                'pesan' => $request->pesan,
                'sudah_dibaca' => false, 
            ]);
            
            // 3. (Opsional) Kirim Notifikasi Email ke Admin
            // (Kode Mailable dihilangkan untuk fokus pada penyimpanan database)

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan pesan kontak: ' . $e->getMessage());
            
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.')->withInput();
        }

        // 4. Redirect dengan Pesan Sukses
        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim. Kami akan segera menghubungi Anda.');
    }
}