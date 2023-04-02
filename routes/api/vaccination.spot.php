<?php

use App\Http\Controllers\SpotController;
use Illuminate\Support\Facades\Route;

Route::prefix('spots')->group(function () {
    Route::middleware(['auth.api', 'role:society'])->group(function () {
        Route::controller(SpotController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/{spot_id}', 'show');
        });
    });
});
