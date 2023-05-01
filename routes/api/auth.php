<?php

use App\Helpers\Auth;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('/logout', 'logout');
        // Route::get('tes', function () {
        //     return ['hai' => 'midd auth', 'exp' => date('Y-m-d h:i:s', time()), 'now' => time(), 'user' => Auth::user(), 'user_id' => Auth::userId(), 'sc' => Auth::society()];
        // })->middleware('auth.api');
    });
});
