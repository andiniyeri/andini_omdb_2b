<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelControl\DashboardController;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\PanelControl\MovieController;
use App\Http\Controllers\PanelControl\FavoriteController;

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
Route::get('/logout', [AuthController::class, 'logout'])->name('signout');


Route::get('favorite', [FavoriteController::class, 'index'])->name('favorite');

// Top-level dashboard route (accessible at /dashboard)
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

route::prefix('control_panel')->middleware('check.login')->group(function () {
    route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Movie Routes
    Route::get('movies', [MovieController::class, 'index'])->name('movies.search');
    Route::get('movies/{imdbId}', [MovieController::class, 'detail'])->name('movies.detail');

    // Favorite Routes
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{imdbId}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
});
