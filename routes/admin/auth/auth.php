<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;

Route::prefix('admin')->name('admin.')->group(function (){
    
    //Show login form
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    //Process Login
    Route::post('/login', [AuthController::class, 'login'])->name('login');


    //Show Registration form
    Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
    
    //Process Registration
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    //Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        
    Route::get('/confirmation/{username}', function ($username) {
    return view('admin.confirmation', compact('username'));
})->name('confirmation');


});