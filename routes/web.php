<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelControl\DashboardController;
use Illuminate\Support\Facades\App;

//swith language
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
        App::setLocale($locale);
    }
    return redirect()->back();
});

// Routing untuk Auth
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register_process'])->name('signup');
Route::post('/login', [AuthController::class, 'login'])->name('signin');

Route::get('favorite', function () {
    return view('control_panel.favorite');
});


route::prefix('control_panel')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
