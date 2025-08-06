<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModsController;

Route::middleware(['auth', 'can:manage-mods'])->group(function () {
    Route::post('/mods/install', [ModsController::class, 'install']);
});
