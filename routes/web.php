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
Route::get('/minat-pekerjaan', fn() => view('job_interest'))->name('job.interest');
Route::get('/kontak', fn() => view('contact_us'))->name('contact');
Route::get('/tentang-perusahaan', fn() => view('about_company'))->name('about');
Route::get('/explore-perusahaan', fn() => view('explore_company'));
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
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register.process'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 


/*
|--------------------------------------------------------------------------
| PANEL ADMIN (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // 1. Dashboard, Lowongan, Pelamar, Perusahaan, Kandidat (tetap sama)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('job_listings', JobListingController::class);

    Route::resource('applicants', ApplicantController::class)->only(['index', 'show', 'destroy']);
    Route::put('applicants/{applicant}/status', [ApplicantController::class, 'updateStatus'])->name('applicants.update_status');

    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('candidates', [CandidateController::class, 'index'])->name('candidates.index');


    // ----------------------------------------------------
    // 4. Manajemen Jadwal/Kalender (ROUTE KHUSUS UNTUK API FULLCALENDAR)
    // ----------------------------------------------------
    Route::prefix('calendar')->name('calendar.')->group(function () {
        // Rute untuk menampilkan View/Halaman Kalender
        Route::get('/', fn() => view('admin.calendar.index'))->name('index'); 

        // Rute API untuk FullCalendar:
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
        Route::post('/store', [CalendarController::class, 'store'])->name('store');
        Route::patch('/update', [CalendarController::class, 'update'])->name('update'); // Untuk drag/resize
        Route::post('/delete', [CalendarController::class, 'destroy'])->name('delete'); // Untuk hapus
    });

    
    // 5. Laporan & Analitik
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');


    /*
    |--------------------------------------------------
    | Rute Khusus Super Admin
    |--------------------------------------------------
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

// =========================================================================
/*
|--------------------------------------------------------------------------
| PANEL WAWANCARA (Prefix & Name Grouping)
|--------------------------------------------------------------------------
*/
// 👇 PERBAIKI BAGIAN INI: Ganti 'role:wawancara' menjadi 'wawancara' (nama alias yang sudah didaftarkan)
Route::prefix('wawancara')->name('wawancara.')->middleware(['auth', 'wawancara'])->group(function () {
    
    // Rute untuk role Wawancara: HANYA LIHAT JADWAL
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        // Rute untuk menampilkan View/Halaman Kalender (Wawancara: HANYA LIHAT)
        Route::get('/', fn() => view('admin.calendar.index'))->name('index'); 

        // Rute API untuk FullCalendar: HANYA AMBIL DATA (GET), tidak ada POST/PATCH/DELETE
        Route::get('/events', [CalendarController::class, 'fetchEvents'])->name('index.events');
    });

    // Anda mungkin juga ingin menambahkan Dashboard khusus, misalnya:
    // Route::get('/dashboard', [DashboardWawancaraController::class, 'index'])->name('dashboard');
});
