<?php

use App\Http\Controllers\admin\auth\AuthController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');




require __DIR__.'/admin/auth/auth.php';


