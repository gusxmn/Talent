<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
});

Route::get('/daftar', function () {
    return view('daftar');
});

Route::get('/masuk', function () {
    return view('login');
});

Route::get('/minat-pekerjaan', function () {
    return view('job_interest');
});

Route::get('/kontak', function () {
    return view('contact_us');
});

Route::get('/lowongan-kerja', function () {
    return view('job');
});


Route::get('/tentang-perusahaan', function () {
    return view('about_company');
});

// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', function () {
    return view('job_type'); // resources/views/job_type.blade.php
})->name('job.type');

// Halaman untuk perusahaan
Route::get('/untuk-perusahaan', function () {
    return view('company');
})->name('company');

// Halaman login untuk perusahaan
Route::get('/login-perusahaan', function () {
    return view('company_login');
})->name('company.login');

// Halaman daftar untuk perusahaan
Route::get('/daftar-perusahaan', function () {
    return view('company_register');
})->name('company.register');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Admin
|--------------------------------------------------------------------------
*/
// ✅ Bisa diakses role: admin & super admin
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // view khusus admin
    })->name('admin.dashboard');
});

// ✅ Hanya super admin yang bisa akses Setting
Route::middleware(['superadmin'])->group(function () {
    Route::get('/admin/setting', function () {
        return view('admin.setting'); // view khusus super admin
    })->name('admin.setting');
});
