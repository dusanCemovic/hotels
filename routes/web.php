<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// LaravelLocalization middleware group
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'localize']
    // localeSessionRedirect - Redirects users based on a locale stored in their session.
    // localizationRedirect - Ensures that URLs are always properly localized (have a locale prefix when needed).
    // localeViewPath - Loads views from locale-specific folders. (resources/views/sl/home.blade.php)
    // localize - Responsible for translating the current route (e.g. /en/rooms -> /sl/sobe)
], function () {
    Route::get('/', function () {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('welcome');
    });

    Route::get(LaravelLocalization::transRoute('routes.dashboard'), function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get(LaravelLocalization::transRoute('routes.profile'), [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch(LaravelLocalization::transRoute('routes.profile'), [ProfileController::class, 'update'])->name('profile.update');
        Route::delete(LaravelLocalization::transRoute('routes.profile'), [ProfileController::class, 'destroy'])->name('profile.destroy');

        // Hotel routes for normal user
        Route::get(LaravelLocalization::transRoute('routes.rooms'), [RoomController::class, 'index'])->name('rooms.index');
        Route::get(LaravelLocalization::transRoute('routes.room'), [RoomController::class, 'show'])->name('rooms.show');

        Route::get(LaravelLocalization::transRoute('routes.my-reservations'), function () {
            return 'My reservations (' . app()->getLocale() . ')';
        })->name('my-reservations');
    });

    // Explicitly group auth routes as well if needed, or rely on auth.php
    require __DIR__ . '/auth.php';
});
