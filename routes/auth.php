<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        // page
        Route::get('login', 'login')->name('login');
        Route::get('register', 'register');

        // proses
        Route::post('login', 'doLogin');
        Route::post('register', 'doRegister');
    });
    Route::post('logout', 'logout')->name('logout');
});
