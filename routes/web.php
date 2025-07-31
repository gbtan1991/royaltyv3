<?php

use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Fallback for global login route (so Laravel's middleware won't break)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');



Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth:admin') // restrict to logged-in admins
    ->name('dashboard');


require __DIR__.'/admin/auth/auth.php';


