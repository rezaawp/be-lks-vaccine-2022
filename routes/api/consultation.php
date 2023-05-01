<?php

use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;

Route::prefix('consultations')->group(function () {
    Route::middleware('auth.api')->group(function () {
        Route::controller(ConsultationController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/', 'index');
        });
    });
});
