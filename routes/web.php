<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
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

        // Hotel routes
        Route::get('/rooms', function () {
            return 'Room listing (' . app()->getLocale() . ')';
        })->name('rooms.index');

        Route::get('/rooms/{room}', function ($room) {
            return 'Room detail: ' . $room . ' (' . app()->getLocale() . ')';
        })->name('rooms.show');

        Route::get('/my-reservations', function () {
            return 'My reservations (' . app()->getLocale() . ')';
        })->name('my-reservations');
    });

    // Explicitly group auth routes as well if needed, or rely on auth.php
    require __DIR__ . '/auth.php';
});
