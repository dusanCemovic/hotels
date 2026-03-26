<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::middleware('guest')->group(function () {
    Route::get(LaravelLocalization::transRoute('routes.register'), [RegisterController::class, 'show'])
        ->name('register');

    Route::post(LaravelLocalization::transRoute('routes.register'), [RegisterController::class, 'store']);

    Route::get(LaravelLocalization::transRoute('routes.login'), [LoginController::class, 'show'])
        ->name('login');

    Route::post(LaravelLocalization::transRoute('routes.login'), [LoginController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post(LaravelLocalization::transRoute('routes.logout'), [LoginController::class, 'destroy'])
        ->name('logout');
});
