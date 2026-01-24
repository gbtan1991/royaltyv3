<?php

use Illuminate\Support\Facades\Route;

// 1. Public routes
Route::get('/', function () {
    return view('auth.login');
});

// 2. Protected admin routes
Route::middleware(['auth:admin'])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Load sub-routes files
    require __DIR__ . '/admin.php';
    require __DIR__ . '/customer.php';
    require __DIR__ . '/transaction.php';



});


require __DIR__ . '/auth.php';



require __DIR__ . '/settings.php';
require __DIR__ . '/rewards.php';