<?php 


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest:admin')->group(function (){
    Route::get('admin/auth/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');

    Route::post('admin/auth/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');
});

Route::post('admin/auth/logout', [AdminAuthController::class, 'logout'])
    ->middleware('auth:admin')
    ->name('admin.logout');