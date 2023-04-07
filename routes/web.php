<?php

use App\Http\Controllers\PollingController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::controller(PollingController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/create-polling', 'create');
        Route::get('/poll/{pollingId}', 'show');

        // proses
        Route::post('/create-polling', 'store');
    });
    Route::controller(VoteController::class)->group(function () {
        Route::post('/voted', 'store');
    });
});

require(__DIR__ . '/auth.php');
