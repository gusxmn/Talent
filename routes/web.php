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
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\CandidateController; 
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\NotifController;
use App\Http\Controllers\Admin\MagangController;

//Company Controllers
use App\Http\Controllers\Company\RegisterController;
use App\Http\Controllers\Company\LoginController;

// Campus Controllers
use App\Http\Controllers\Campus\RegisterController as CampusRegisterController;
use App\Http\Controllers\Campus\LoginController as CampusLoginController;

// Public Controllers
use App\Http\Controllers\JobController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\UserNotifController;




/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('home'))->name('home');
Route::get('/daftar', fn() => view('daftar'))->name('register');
Route::get('/masuk', fn() => view('login'))->name('login');
Route::get('/kampus/perusahaan', fn() => view('kampus_perusahaan'))->name('kampus_perusahaan');
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

    // RUTE BARU: Halaman Akun Terhubung
    Route::get('/pengaturan/akun-terhubung', [AccountSettingsController::class, 'linkedAccountsIndex'])->name('account.linked');

    // 👇 RUTE BARU: Halaman Preferensi Notifikasi
    Route::get('/pengaturan/notifikasi', [AccountSettingsController::class, 'notificationIndex'])->name('account.notifications');
    
    // 👇 RUTE BARU: Halaman Bantuan & Dukungan (Tambahan Sesuai Permintaan)
    Route::get('/pengaturan/bantuan-dukungan', [AccountSettingsController::class, 'helpSupportIndex'])->name('account.help.support');

    // Rute POST untuk ganti kata sandi
    Route::post('/pengaturan/update-password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');

    // Rute POST untuk perbarui email
    Route::post('/pengaturan/update-email', [AccountSettingsController::class, 'updateEmail'])->name('account.update.email');
    
    // RUTE BARU: Rute POST untuk perbarui WhatsApp
    Route::post('/pengaturan/update-whatsapp', [AccountSettingsController::class, 'updateWhatsapp'])->name('account.update.whatsapp');

    // 🌟 RUTE BARU: Proses Hapus Akun Permanen
    Route::post('/pengaturan/delete-account', [AccountSettingsController::class, 'deleteAccount'])->name('account.delete.process');

    // RUTE BARU: Rute POST untuk SIMULASI pemutusan koneksi akun
    // Ini hanya akan menyimpan status session 'disconnected'
    Route::post('/pengaturan/dummy-disconnect', [AccountSettingsController::class, 'dummyDisconnect'])->name('account.dummy.disconnect'); // 👈 Rute Baru
});
// 🌟 API NOTIFIKASI VERSI USER
Route::middleware(['auth'])->group(function () {
    // Halaman notifikasi user
     Route::get('/notifications/my', [UserNotifController::class, 'myNotifications'])->name('notifications.my');
    Route::get('/notifications/api', [UserNotifController::class, 'getMyNotificationsApi'])->name('notifications.api');
    Route::put('/notifications/api/read/{id}', [UserNotifController::class, 'markAsReadApi'])->name('notifications.api.read');
     // 🌟 Tambahkan ini
    Route::post('/notifications/mark-all-read', [UserNotifController::class, 'markAllRead'])
        ->name('notifications.markAllRead');
        // Tandai notifikasi sebagai sudah dibaca (untuk satu notifikasi)
Route::post('/notifications/read/{id}', [UserNotifController::class, 'markAsRead'])
    ->name('notifications.markRead');

});

// Halaman tipe pekerjaan
Route::get('/tipe-pekerjaan', fn() => view('job_type'))->name('job.type');

// Halaman perusahaan
Route::get('/perusahaan', fn() => view('company'))->name('company');
Route::get('/login-perusahaan', [App\Http\Controllers\Company\LoginController::class, 'showLoginForm'])->name('company.login');
Route::post('/login-perusahaan', [App\Http\Controllers\Company\LoginController::class, 'login'])->name('company.login.submit');
Route::post('/logout-perusahaan', [App\Http\Controllers\Company\LoginController::class, 'logout'])->name('company.logout');

Route::get('/daftar-perusahaan', [App\Http\Controllers\Company\RegisterController::class, 'showStep1'])->name('company.register');
Route::post('/proses-daftar-perusahaan/step1', [App\Http\Controllers\Company\RegisterController::class, 'processStep1'])->name('company.register.step1');
Route::get('/proses-daftar-perusahaan', [App\Http\Controllers\Company\RegisterController::class, 'showStep2'])->name('company.register.process');
Route::post('/proses-daftar-perusahaan/step2', [App\Http\Controllers\Company\RegisterController::class, 'processStep2'])->name('company.register.step2');
Route::get('/lokasi-daftar-perusahaan', [App\Http\Controllers\Company\RegisterController::class, 'showStep3'])->name('company.register.location');
Route::post('/lokasi-daftar-perusahaan/step3', [App\Http\Controllers\Company\RegisterController::class, 'processStep3'])->name('company.register.step3');
Route::get('/cancel-registration', [App\Http\Controllers\Company\RegisterController::class, 'cancelRegistration'])->name('company.register.cancel');
Route::get('/dashboard-perusahaan', fn() => view('company_dashboard'))->name('company.dashboard')->middleware('auth.company');



// Halaman kampus
Route::get('/kampus', fn() => view('campus'))->name('campus');
Route::get('/login-kampus', [App\Http\Controllers\Campus\LoginController::class, 'showLoginForm'])->name('campus.login');
Route::post('/login-kampus', [App\Http\Controllers\Campus\LoginController::class, 'login'])->name('campus.login.submit');

// Logout POST tetap ada (tidak dihapus)
Route::post('/logout-kampus', [App\Http\Controllers\Campus\LoginController::class, 'logout'])->name('campus.logout');

Route::get('/daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep1'])->name('campus.register');
Route::post('/proses-daftar-kampus/step1', [App\Http\Controllers\Campus\RegisterController::class, 'processStep1'])->name('campus.register.step1');
Route::get('/proses-daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep2'])->name('campus.register.process');
Route::post('/proses-daftar-kampus/step2', [App\Http\Controllers\Campus\RegisterController::class, 'processStep2'])->name('campus.register.step2');
Route::get('/lokasi-daftar-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'showStep3'])->name('campus.register.location');
Route::post('/lokasi-daftar-kampus/step3', [App\Http\Controllers\Campus\RegisterController::class, 'processStep3'])->name('campus.register.step3');
Route::get('/cancel-registration-kampus', [App\Http\Controllers\Campus\RegisterController::class, 'cancelRegistration'])->name('campus.register.cancel');

Route::middleware('auth.campus')->group(function () {
    Route::get('/dashboard-kampus', fn() => view('campus_dashboard'))->name('campus.dashboard');
});


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

    //Halaman Manajemen Perusahaan
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::post('companies', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('companies/{company}', [CompanyController::class, 'show'])->name('companies.show'); // TAMBAHKAN SHOW
    Route::delete('companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    //Halaman Manajemen Kampus/Sekolah
    Route::resource('campus', CampusController::class)->only(['index', 'show', 'destroy']);

    // TAMBAHAN: Routes untuk Pemagang (Interns)
    Route::prefix('interns')->name('interns.')->group(function () {
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

    
    // Contact messages admin management
    Route::resource('contact-messages', AdminContactController::class)->only(['index','show','destroy']);
    Route::post('contact-messages/{id}/restore', [AdminContactController::class, 'restore'])->name('contact-messages.restore');
    


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