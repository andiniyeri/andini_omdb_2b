<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register',[AuthController::class, 'register_process'])->name('signup');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('control_panel.dashboard');
});

Route::get('/logout', function () {
    return view('auth.login');
});

Route::get('/favorite', function () {
    return view('control_panel.favorite');
});

Route::get('/header', function () {
    return view('layout.header');
});

Route::get('/sidebar', function () {
    return view('layout.sidebar');
});

Route::get('/footer', function () {
    return view('layout.footer');
});
