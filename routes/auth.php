<?php 

use App\Http\Controllers\auth\AuthController;

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
