<?php

use App\Http\Controllers\rewards\RewardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:admin'])
    ->prefix('rewards')
    ->name('rewards.')
    ->group(function () {
        
        Route::resource('/', RewardController::class)
            ->parameters(['' => 'reward']); 
            
    });