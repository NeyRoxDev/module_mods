<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserPreferencesController;

// Mods management
Route::get('/mods', [AdminController::class, 'index']);
Route::post('/mods/install', [AdminController::class, 'install']);
Route::post('/mods/uninstall', [AdminController::class, 'uninstall']);

// User preferences
Route::get('/user/preferences', [UserPreferencesController::class, 'show']);
Route::post('/user/preferences', [UserPreferencesController::class, 'update']);
