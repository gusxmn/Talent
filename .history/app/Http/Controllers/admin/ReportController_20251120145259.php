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
     * Dashboard Laporan Utama
     */
    public function index(Request $request)
    {
        // Statistik Utama
        $totalApplications = Application::count();
        $activeJobListings = JobListing::where('is_active', true)->count();
        $monthlyApplications = Application::whereMonth('applied_at', now()->month)->count();
        $weeklyApplications = Application::whereBetween('applied_at', [now()->startOfWeek(), now()->endOfWeek()])->count();

        // Data untuk tables
        $recentApplications = Application::with(['jobListing', 'candidate'])
                                       ->latest()
                                       ->limit(10)
                                       ->get();

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