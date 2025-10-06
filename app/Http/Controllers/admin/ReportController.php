<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\JobListing;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Tampilkan halaman utama laporan/analitik.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Total Aplikasi
        $totalApplications = Application::count();
        
        // Total Lowongan Aktif
        $activeJobListings = JobListing::where('is_active', true)->count();

        // Statistik Status (Contoh: Menghitung jumlah per status)
        $statusCounts = Application::select('status', DB::raw('count(*) as total'))
                                    ->groupBy('status')
                                    ->pluck('total', 'status')
                                    ->toArray();
        
        // Statistik Aplikasi Bulanan (Hanya untuk 6 bulan terakhir)
        $monthlyApplications = Application::select(
            DB::raw('COUNT(*) as count'),
            DB::raw("DATE_FORMAT(applied_at, '%Y-%m') as month_year")
        )
        ->where('applied_at', '>=', now()->subMonths(6))
        ->groupBy('month_year')
        ->orderBy('month_year')
        ->pluck('count', 'month_year');
        
        
        // Statistik Lowongan Paling Populer (Contoh: 5 teratas)
        $popularJobs = JobListing::withCount('applications')
                                 ->orderByDesc('applications_count')
                                 ->limit(5)
                                 ->get();

        return view('admin.reports.index', [
            'totalApplications' => $totalApplications,
            'activeJobListings' => $activeJobListings,
            'statusCounts' => $statusCounts,
            'monthlyApplications' => $monthlyApplications,
            'popularJobs' => $popularJobs,
        ]);
    }
    
    // Metode tambahan bisa ditambahkan di sini (misal: generatePdfReport)
}