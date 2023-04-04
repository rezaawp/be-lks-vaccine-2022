<?php

use App\Http\Controllers\VaccinationController;
use Illuminate\Support\Facades\Route;

Route::prefix('vaccinations')->group(function () {
    Route::middleware('auth.api')->group(function () {
        Route::controller(VaccinationController::class)->group(function () {
            Route::post('/', 'store');
            Route::get('/', 'index');
        });
    });
});
