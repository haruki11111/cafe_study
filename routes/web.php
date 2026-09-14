<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\StudyLogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteCafeController;

Route::get('/', function () {
    return redirect('/dashboard-cafe');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cafes', CafeController::class);
    Route::resource('foods', FoodController::class);
    Route::resource('study-logs', StudyLogController::class);
    Route::resource('favorite-cafe', FavoriteCafeController::class);

    Route::get('/dashboard-cafe', [DashboardController::class, 'index'])
        ->name('dashboard-cafe');
});


require __DIR__ . '/settings.php';
