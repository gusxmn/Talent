<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\ScheduleController; // <-- DITAMBAHKAN
use App\Http\Controllers\Admin\ReportController;   // <-- DITAMBAHKAN
// Public Controllers
use App\Http\Controllers\JobController;


/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/daftar', fn() => view('daftar'))->name('register'); // Tambahkan name
Route::get('/masuk', fn() => view('login'))->name('login'); // Tambahkan name
Route::get('/minat-pekerjaan', fn() => view('job_interest'))->name('job.interest');
Route::get('/kontak', fn() => view('contact_us'))->name('contact');
Route::get('/tentang-perusahaan', fn() => view('about_company'))->name('about');
Route::get('/explore-perusahaan', fn() => view('explore_company'));
Route::get('/sumber-daya-karir', fn() => view('career_resources'));


// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', fn() => view('job_type'))->name('job.type');

// Halaman untuk perusahaan
Route::get('/untuk-perusahaan', fn() => view('company'))->name('company');
Route::get('/login-perusahaan', fn() => view('company_login'))->name('company.login');
Route::get('/daftar-perusahaan', fn() => view('company_register'))->name('company.register');

// Halaman publik Job
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
// Rute login process sudah benar
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
// Gunakan POST untuk logout jika Anda menerapkan CSRF protection di form
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 
// Anda juga bisa mempertahankan GET, tapi POST lebih aman jika menggunakan form/link non-JS di layout
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout'); 


/*
|--------------------------------------------------------------------------
| PANEL ADMIN (Prefix & Name Grouping)
|--------------------------------------------------------------------------
| Middleware 'admin' diasumsikan mengizinkan 'admin' dan 'super admin'.
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // 1. Dashboard (Akses Admin & Super Admin)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Manajemen Lowongan (Akses Admin & Super Admin)
    Route::resource('job_listings', JobListingController::class);

    // 3. Manajemen Pelamar (Akses Admin & Super Admin)
    Route::resource('applicants', ApplicantController::class)->only([
        'index', 'show', 'destroy'
    ]);
    Route::put('applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('applicants.update_status');

    // 4. Manajemen Jadwal (Akses Admin & Super Admin) <--- DIBETULKAN
    Route::resource('schedules', ScheduleController::class);

    Route::get('schedules-events', [ScheduleController::class, 'events'])->name('schedules.events');
    
    // 5. Laporan & Analitik (Akses Admin & Super Admin) <--- DITAMBAHKAN
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');


    /*
    |--------------------------------------------------
    | Rute Khusus Super Admin
    |--------------------------------------------------
    | Middleware 'superadmin' diasumsikan hanya mengizinkan 'super admin'.
    */
    Route::middleware(['superadmin'])->group(function () {
        
        // Pengaturan Sistem
        Route::get('/setting', fn() => view('admin.setting'))->name('setting');

        // CRUD User
        Route::resource('users', UserController::class);
        Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');

        // CRUD Lokasi
        Route::resource('lokasi', LokasiController::class);
    });


});