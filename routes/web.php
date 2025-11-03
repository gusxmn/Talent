<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\CalendarController; // <-- CONTROLLER BARU UNTUK KALENDER
use App\Http\Controllers\Admin\ReportController; 
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\CandidateController; 
// Public Controllers
use App\Http\Controllers\JobController;


/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/daftar', fn() => view('daftar'))->name('register');
Route::get('/masuk', fn() => view('login'))->name('login');
Route::get('/perusahaan/kampus', fn() => view('perusahaan_kampus'))->name('perusahaan_kampus');
Route::get('/minat-pekerjaan', fn() => view('job_interest'))->name('job.interest');
Route::get('/kontak', fn() => view('contact_us'))->name('contact');
Route::get('/tentang-perusahaan', fn() => view('about_company'))->name('about');
Route::get('/explore-perusahaan', fn() => view('explore_company'));
Route::get('/open-intership', fn() => view('open_intership'));
Route::get('/registrasi-perusahaan', fn() => view('daftar_perusahaan'));
Route::get('/registrasi-kampus', fn() => view('daftar_kampus'));
Route::get('/sumber-daya-karir', fn() => view('career_resources'));

Route::get('/sumber-daya-karir/jelajahi-karier', function () {
    return view('career_explore');
})->name('career.explore');

Route::get('/sumber-daya-karir/pencarian-lowongan-kerja', function () {
    return view('job_search_page');
})->name('job.search.page');

Route::get('/sumber-daya-karir/kehidupan-kerja', function () {
    return view('job_life');
})->name('job.life');

Route::get('/sumber-daya-karir/jelajahi-gaji', function () {
    return view('salary_explore');
})->name('salary.explore');


// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', fn() => view('job_type'))->name('job.type');

// Halaman perusahaan
Route::get('/perusahaan', fn() => view('company'))->name('company');
Route::get('/login-perusahaan', fn() => view('company_login'))->name('company.login');
Route::get('/daftar-perusahaan', fn() => view('company_register'))->name('company.register');

// Halaman kampus
Route::get('/kampus', fn() => view('campus'))->name('campus');
Route::get('/login-kampus', fn() => view('campus_login'))->name('campus.login');
Route::get('/daftar-kampus', fn() => view('campus_register'))->name('campus.register');


// Halaman publik Job
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

// ✅ TAMBAHAN RUTE GOOGLE LOGIN
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


/*
|--------------------------------------------------------------------------
| PANEL ADMIN (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // 1. Dashboard, Lowongan, Pelamar, Perusahaan, Kandidat
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     // 🔔 Route Notifikasi
    // Form kirim notifikasi (admin -> user)
    Route::get('/notif', [NotifController::class, 'index'])->name('notif.index');
    Route::post('/notif/send', [NotifController::class, 'send'])->name('notif.send');

    // Halaman notifikasi milik user login
    Route::get('/notif/my', [NotifController::class, 'myNotifications'])->name('notif.my');

    // Tandai notifikasi sebagai dibaca
    Route::put('/notif/read/{id}', [NotifController::class, 'markAsRead'])->name('notif.read');

    // (Opsional) lihat notifikasi user lain (buat superadmin)
    Route::get('/notif/user/{id}', [NotifController::class, 'userNotifications'])->name('notif.user');

    // 🔔 API ROUTES UNTUK NOTIFIKASI DROPDOWN
    Route::get('/notif/api/my', [NotifController::class, 'getMyNotificationsApi'])->name('notif.api.my');
    Route::put('/notif/api/read/{id}', [NotifController::class, 'markAsReadApi'])->name('notif.api.read');

    // Lowongan Magang
    Route::resource('magang', MagangController::class);
    Route::get('/api/magang/regencies/{provinceId}', [MagangController::class, 'getRegencies'])->name('magang.api.regencies');
    Route::get('/api/magang/districts/{regencyId}', [MagangController::class, 'getDistricts'])->name('magang.api.districts');
    Route::get('/api/magang/villages/{districtId}', [MagangController::class, 'getVillages'])->name('magang.api.villages');

        // Lowongan Magang
    Route::resource('magang', MagangController::class);
    Route::get('/api/magang/regencies/{provinceId}', [MagangController::class, 'getRegencies'])->name('magang.api.regencies');
Route::get('/api/magang/districts/{regencyId}', [MagangController::class, 'getDistricts'])->name('magang.api.districts');
Route::get('/api/magang/villages/{districtId}', [MagangController::class, 'getVillages'])->name('magang.api.villages');



    // Job Listings Routes - HAPUS DUPLIKAT
    Route::resource('job_listings', JobListingController::class);
    
    // Tambahan routes untuk JobListing
    Route::patch('/job-listings/{job_listing}/publish', [JobListingController::class, 'publish'])
        ->name('job_listings.publish');
    Route::patch('/job-listings/{job_listing}/set-draft', [JobListingController::class, 'setDraft'])
        ->name('job_listings.set-draft');
    Route::post('/job-listings/{job_listing}/duplicate', [JobListingController::class, 'duplicate'])
        ->name('job_listings.duplicate');
    Route::post('/job-listings/bulk-action', [JobListingController::class, 'bulkAction'])
        ->name('job_listings.bulk-action');
    Route::get('/job-listings/export', [JobListingController::class, 'export'])
        ->name('job_listings.export');

    // API endpoints untuk wilayah
    Route::get('/api/regencies/{provinceId}', [JobListingController::class, 'getRegencies'])->name('api.regencies');
    Route::get('/api/districts/{regencyId}', [JobListingController::class, 'getDistricts'])->name('api.districts');
    Route::get('/api/villages/{districtId}', [JobListingController::class, 'getVillages'])->name('api.villages');
    Route::get('/api/location-details', [JobListingController::class, 'getLocationDetails'])->name('api.location-details');
    Route::get('/api/job-stats', [JobListingController::class, 'getStats'])->name('api.job-stats');

    Route::resource('applicants', ApplicantController::class)->only(['index', 'show', 'destroy']);
    Route::put('applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('applicants.update_status');

    Route::get('companies', [CompanyController::class, 'index'])->name('admin.companies.index');
    Route::resource('companies', CompanyController::class)->names('companies');
    

    // TAMBAHAN: Routes untuk Pemagang (Interns)
    Route::prefix('interns')->name('interns.')->group(function () {
    });

    // TAMBAHAN: Routes untuk Campus
    Route::prefix('campuses')->name('campuses.')->group(function () {
        Route::get('/', [CampusController::class, 'index'])->name('index');
        // Route::get('/create', [CampusController::class, 'create'])->name('create');
        // Route::post('/', [CampusController::class, 'store'])->name('store');
        // Route::get('/{id}', [CampusController::class, 'show'])->name('show');
        // Route::get('/{id}/edit', [CampusController::class, 'edit'])->name('edit');
        // Route::put('/{id}', [CampusController::class, 'update'])->name('update');
        // Route::delete('/{id}', [CampusController::class, 'destroy'])->name('destroy');
        // Route::get('/export/excel', [CampusController::class, 'exportExcel'])->name('export.excel');
        // Route::get('/{id}/students', [CampusController::class, 'getStudents'])->name('students');
    });

    // 4. Manajemen Jadwal/Kalender
    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::get('/', fn() => view('admin.calendar.index'))->name('index'); 
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
        Route::post('/store', [CalendarController::class, 'store'])->name('store');
        Route::patch('/update', [CalendarController::class, 'update'])->name('update');
        Route::post('/delete', [CalendarController::class, 'destroy'])->name('delete');
    });
    
    // 5. Laporan & Analitik
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');


    /*
    |--------------------------------------------------
    | Rute Khusus Super Admin
    |--------------------------------------------------
    */
    Route::middleware(['superadmin'])->group(function () {
        Route::get('/setting', fn() => view('admin.setting'))->name('setting');
        Route::resource('users', UserController::class);
        Route::post('users/{id}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::get('users/search', [UserController::class, 'search'])->name('users.search');
        Route::resource('lokasi', LokasiController::class);
    });
});

/*
|--------------------------------------------------------------------------
| PANEL WAWANCARA (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
Route::prefix('wawancara')->name('wawancara.')->middleware(['auth', 'wawancara'])->group(function () {
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', fn() => view('admin.calendar.index'))->name('index'); 
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
    });
});