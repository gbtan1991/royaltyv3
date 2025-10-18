<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/



// Redirect root to admin login
Route::redirect('/', 'admin/auth/login');

// Import Auth Routes for Admin
require __DIR__ . '/auth.php';


// Protected routes for authenticated admin users
Route::middleware('auth:admin')->group(function(){
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('admin', AdminController::class);
});





