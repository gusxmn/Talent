<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// Admin Controllers
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\JobListingController;
use App\Http\Controllers\Admin\ApplicantController;
use App\Http\Controllers\Admin\CalendarController; 
use App\Http\Controllers\Admin\ReportController; 
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\CandidateController; 
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// Public Controllers
use App\Http\Controllers\JobController;
use App\Http\Controllers\ContactController; 


/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/daftar', fn() => view('daftar'))->name('register');
Route::get('/masuk', fn() => view('login'))->name('login');
Route::get('/minat-pekerjaan', fn() => view('job_interest'))->name('job.interest');

// START: PERUBAHAN DI BAGIAN KONTAK (Sekarang hanya menggunakan 2 rute di satu URI)
// KEDUA ROUTE INI SUDAH BENAR DAN MENGARAH KE ContactController
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
// END: PERUBAHAN DI BAGIAN KONTAK

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

// Halaman pengaturan akun dan fungsionalitasnya
Route::middleware(['auth'])->group(function () {
    // Rute utama halaman pengaturan akun (Detail Login)
    Route::get('/pengaturan/detail', [AccountSettingsController::class, 'index'])->name('account.settings');
    
    // RUTE BARU: Halaman Kontak Saya
    Route::get('/pengaturan/kontak', [AccountSettingsController::class, 'contactIndex'])->name('account.contact');

    // Rute POST untuk ganti kata sandi
    Route::post('/pengaturan/update-password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');

    // Rute POST untuk perbarui email
    Route::post('/pengaturan/update-email', [AccountSettingsController::class, 'updateEmail'])->name('account.update.email');
    
    // RUTE BARU: Rute POST untuk perbarui WhatsApp
    Route::post('/pengaturan/update-whatsapp', [AccountSettingsController::class, 'updateWhatsapp'])->name('account.update.whatsapp');
});


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

// ✅ TAMBAHAN RUTE GOOGLE LOGIN
Route::get('auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

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

    // Contact messages admin management
    Route::resource('contact-messages', AdminContactController::class)->only(['index','show','destroy']);
    Route::post('contact-messages/{id}/restore', [AdminContactController::class, 'restore'])->name('contact-messages.restore');


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