<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Ganti dengan namespace model aplikasi Anda yang sebenarnya
use App\Models\Application; 
use Illuminate\Support\Facades\Gate; 

class ApplicantController extends Controller
{
    /**
     * Tampilkan daftar (index) dari semua aplikasi pelamar.
     * Termasuk fitur pencarian dan filter status.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Pastikan hanya role 'admin' atau 'super admin' yang bisa mengakses
        // Jika Anda menggunakan Gate/Policy, terapkan di sini.
        // if (!Gate::allows('manage-applicants')) {
        //     abort(403);
        // }
        
        $search = $request->get('search');
        $statusFilter = $request->get('status');
        $perPage = $request->get('per_page', 10); // Default 10 data per halaman

        $applications = Application::query()
            ->with(['jobListing', 'user']) // Eager loading relasi jobListing dan user
            
            // 1. Pencarian (Search)
            // Mencari berdasarkan nama pelamar atau judul lowongan
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('jobListing', function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%');
                });
            })
            
            // 2. Filter Status
            ->when($statusFilter && $statusFilter !== 'all', function ($query, $status) {
                $query->where('status', $status);
            })
            
            // Urutkan berdasarkan tanggal aplikasi terbaru
            ->latest()
            
            // Pagination
            ->paginate($perPage)
            ->withQueryString(); 
        
        // Daftar status yang tersedia untuk dropdown filter
        $statuses = [
            'all' => 'Semua Status',
            'pending' => 'Menunggu Review',
            'reviewed' => 'Sudah Direview',
            'interview' => 'Jadwal Interview',
            'rejected' => 'Ditolak',
            'hired' => 'Diterima',
        ];

        return view('admin.applicants.index', [
            'applications' => $applications,
            'statuses' => $statuses,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Tampilkan detail spesifik dari satu aplikasi pelamar.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Temukan aplikasi beserta detail relasi
        $application = Application::with(['jobListing', 'user'])->findOrFail($id);
        
        // Logika untuk menampilkan detail lamaran (CV, surat lamaran, dll)
        
        return view('admin.applicants.show', compact('application'));
    }

    // Metode destroy() untuk menghapus aplikasi pelamar
    public function destroy($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.applicants.index')->with('success', 'Lamaran berhasil dihapus.');
    }
}