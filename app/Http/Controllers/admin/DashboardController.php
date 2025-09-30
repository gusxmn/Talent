<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lokasi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik user berdasarkan role
        $userRoles = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        // Statistik aktivitas user per hari (dummy pakai created_at user)
        $userActivities = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('total', 'date');

        // Statistik lokasi berdasarkan provinsi
        $lokasiStats = Lokasi::select('provinsi', DB::raw('count(*) as total'))
            ->groupBy('provinsi')
            ->orderBy('provinsi', 'asc')
            ->pluck('total', 'provinsi');

        return view('admin.dashboard', compact('userRoles', 'userActivities', 'lokasiStats'));
    }
}
