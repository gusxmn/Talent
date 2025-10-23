<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Menampilkan daftar pesan kontak dengan opsi filter soft delete.
     * Filter status: 
     * - null/other: Tanpa data yang dihapus (hanya aktif)
     * - with: Dengan data yang dihapus (semua data)
     * - only: Hanya data yang dihapus (onlyTrashed)
     */
    public function index(Request $request)
    {
        // Mendapatkan filter status dari request, default 'without'
        $status = $request->query('status', 'without');
        
        $query = ContactMessage::orderBy('created_at', 'asc');

        if ($status === 'only') {
            // Hanya data yang dihapus (onlyTrashed).
            $messages = $query->onlyTrashed()->paginate(10);
            
        } elseif ($status === 'with') {
            // Dengan data yang dihapus (withTrashed).
            $messages = $query->withTrashed()->paginate(10);

        } else {
            // Default: Tanpa data yang dihapus (hanya yang tidak soft deleted)
            $messages = $query->whereNull('deleted_at')->paginate(10);
        }

        // Catatan: Karena Anda sudah menggunakan logika Soft Deletes Laravel,
        // filter menggunakan 'deleted_at' lebih konsisten daripada kolom 'active', 
        // namun saya pertahankan logika 'active' di destroy/restore sesuai request Anda.
        
        // Kirimkan variabel $status (filter) ke view
        return view('admin.contact.index', compact('messages', 'status'));
    }

    public function show($id)
    {
        // Gunakan withTrashed() agar bisa melihat pesan yang sudah di-soft delete
        $message = ContactMessage::withTrashed()->findOrFail($id);

        // set read_at dan status jika belum
        if (!$message->read_at) {
            $message->update([
                'read_at' => now(),
                'status' => 1, // SET STATUS MENJADI 1 (Sudah Dibaca)
            ]);
        }

        return view('admin.contact.show', compact('message'));
    }

    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);

        // 1. SET active menjadi 0 (Tidak Aktif/Dihapus dari tampilan) - Sesuai logika Anda
        $message->update(['active' => 0]);

        // 2. Lakukan Soft Delete (mengisi kolom deleted_at)
        $message->delete(); 

        return redirect()->route('admin.contact-messages.index')->with('success', 'Pesan berhasil disembunyikan.');
    }
    
    public function restore($id)
    {
        // Cari pesan yang di-soft delete (hanya yang terhapus)
        // Kita harus menggunakan withTrashed() untuk mencari ID meskipun hanyaTrashed akan digunakan.
        // Jika Anda menggunakan hanyaTrashed, maka pesan ini pasti dihapus
        $message = ContactMessage::withTrashed()->findOrFail($id);
        
        // 1. Pulihkan Soft Delete (mengosongkan kolom deleted_at)
        $message->restore();

        // 2. Kembalikan active menjadi 1 - Sesuai logika Anda
        $message->update(['active' => 1]);


        // Alihkan kembali ke halaman data terhapus, lalu beri notifikasi
        return redirect()->route('admin.contact-messages.index', ['status' => 'only'])->with('success', 'Pesan berhasil dipulihkan dan ditampilkan kembali di Pesan Aktif.');
    }
}
