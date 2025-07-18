<?php 

use App\Http\Controllers\admin\auth\AuthSessionController;


Route::middleware('guest')->group(function(){
    Route::get('login', [AuthSessionController::class, 'create'])
    ->name('login');


});