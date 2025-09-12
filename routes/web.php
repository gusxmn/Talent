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