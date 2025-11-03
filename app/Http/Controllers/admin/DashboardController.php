<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Application;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah data dari database
        $activeJobsCount = JobListing::where('is_public', true)->count();
        $newApplicationsCount = Application::where('status', 'baru')->count();
        $companiesCount = Company::count();
        $totalUsersCount = User::count();

        // Grafik 1: Distribusi Role User
        $userRoles = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        // GANTI INI: Statistik Lowongan per Provinsi (bukan location)
        $lokasiStats = JobListing::with('province')
            ->select('provinsi_id', DB::raw('count(*) as total'))
            ->whereNotNull('provinsi_id')
            ->groupBy('provinsi_id')
            ->get()
            ->pluck('total', 'province.name');

        // Atau alternatif: Statistik berdasarkan jenis pekerjaan
        $jobTypeStats = JobListing::select('job_type', DB::raw('count(*) as total'))
            ->groupBy('job_type')
            ->pluck('total', 'job_type');

        return view('admin.dashboard', compact(
            'activeJobsCount',
            'newApplicationsCount',
            'companiesCount',
            'totalUsersCount',
            'userRoles',
            'lokasiStats',
            'jobTypeStats'
        ));
    }
}