<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.auth.login');
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Auth Routes for Admin
Route::get('admin/auth/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/auth/login', [App\Http\Controllers\Auth\AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('admin/auth/logout', [App\Http\Controllers\Auth\AdminAuthController::class, 'logout'])->name('admin.logout');


// Protecting dashboard and crud routes
Route::middleware('auth:admin')->group(function(){
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('admin', AdminController::class);
});


