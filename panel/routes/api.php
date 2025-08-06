<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserPreferencesController;

Route::middleware('auth')->group(function () {
    Route::get('/preferences', [UserPreferencesController::class, 'index']);
    Route::post('/preferences', [UserPreferencesController::class, 'store']);
});

