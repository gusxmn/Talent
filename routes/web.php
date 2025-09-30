<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'));
Route::get('/daftar', fn() => view('daftar'));
Route::get('/masuk', fn() => view('login'));
Route::get('/minat-pekerjaan', fn() => view('job_interest'));
Route::get('/kontak', fn() => view('contact_us'));
Route::get('/explore-perusahaan', fn() => view('explore_company'));
Route::get('/tentang-perusahaan', fn() => view('about_company'));

// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', fn() => view('job_type'))->name('job.type');

// Halaman untuk perusahaan
Route::get('/untuk-perusahaan', fn() => view('company'))->name('company');
Route::get('/login-perusahaan', fn() => view('company_login'))->name('company.login');
Route::get('/daftar-perusahaan', fn() => view('company_register'))->name('company.register');

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
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

// ✅ Hanya super admin yang bisa akses Setting & Manajemen User
Route::middleware(['superadmin'])->group(function () {
    Route::get('/admin/setting', fn() => view('admin.setting'))->name('admin.setting');

    // CRUD User
    Route::resource('/admin/users', UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'show'    => 'admin.users.show',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);

    // Tambahan fitur lain (reset password, search)
    Route::post('/admin/users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::get('/admin/users/search', [UserController::class, 'search'])->name('admin.users.search');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::get('/lowongan-kerja', function () {
    return view('job');
});

Route::middleware(['admin'])->group(function () {
    Route::resource('/admin/lokasi', LokasiController::class)->names([
        'index'   => 'admin.lokasi.index',
        'create'  => 'admin.lokasi.create',
        'store'   => 'admin.lokasi.store',
        'show'    => 'admin.lokasi.show',
        'edit'    => 'admin.lokasi.edit',
        'update'  => 'admin.lokasi.update',
        'destroy' => 'admin.lokasi.destroy',
    ]);
});