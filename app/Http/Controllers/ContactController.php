<?php

namespace App\Http\Controllers;

use App\Models\Profile; // Pastikan Model Profile sudah di-import
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // PERUBAHAN: Menerima Request untuk membaca session flash
    public function index(Request $request)
    {
        // Ambil data profile
        $profile = Profile::first();

        // Cek apakah ada session flash 'success_message' yang dikirim dari method store()
        $success_message = $request->session()->get('success_message');

        // Kirim data 'profile' dan 'success_message' ke view 'contact'
        return view('contact', compact('profile', 'success_message'));
    }

    
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'nullable|string|max:191',
            'phone'   => 'nullable|string|max:50',
            'email'   => 'nullable|email|max:191',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        ContactMessage::create($data);

        // UBAH: Alihkan kembali ke halaman kontak (route 'contact') 
        // dengan menyertakan data flash 'success_message'
        return redirect()->route('contact')->with('success_message', true);
    }

    // PERHATIAN: Method public function success() telah dihapus
}
