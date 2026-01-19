<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function() {
    return view('dashboard');
})->middleware(['auth:admin'])->name('dashboard');



require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
require __DIR__.'/customer.php';
require __DIR__.'/transaction.php';
