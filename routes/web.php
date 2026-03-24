<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// LaravelLocalization middleware group
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    // localeSessionRedirect - Redirects users based on a locale stored in their session.
    // localizationRedirect - Ensures that URLs are always properly localized (have a locale prefix when needed).
    // localeViewPath - Loads views from locale-specific folders. (resources/views/sl/home.blade.php)
], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Hotel routes for normal user
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');

        Route::get('/my-reservations', function () {
            return 'My reservations (' . app()->getLocale() . ')';
        })->name('my-reservations');
    });

    // Explicitly group auth routes as well if needed, or rely on auth.php
    require __DIR__ . '/auth.php';
});
