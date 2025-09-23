<?php

use Illuminate\Support\Facades\Route;

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