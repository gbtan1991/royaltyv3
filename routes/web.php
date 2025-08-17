<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    Route::get('/login', AuthController::class, 'showLoginForm')->name('admin.login');
    Route::post('/login', AuthController::class, 'login')->name('admin.login.submit');
    Route::post('/logout', AuthController::class, 'logout')->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});