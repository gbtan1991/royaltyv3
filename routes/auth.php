<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\DashboardController;


// Public login + logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');




// Protected admin routes
Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});
