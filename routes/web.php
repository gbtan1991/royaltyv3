<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');



require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
