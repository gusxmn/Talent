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

        // Grafik 2: Statistik Lowongan per Lokasi
        $lokasiStats = JobListing::select('location', DB::raw('count(*) as total'))
            ->groupBy('location')
            ->pluck('total', 'location');

        return view('admin.dashboard', compact(
            'activeJobsCount',
            'newApplicationsCount',
            'companiesCount',
            'totalUsersCount',
            'userRoles',
            'lokasiStats'
        ));
    }
}