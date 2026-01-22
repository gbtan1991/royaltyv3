<?php 

use App\Http\Controllers\settings\SettingsController;



Route::middleware('auth:admin')
    ->prefix('settings')
    ->name('settings.')
    ->group(function() {

        // The main page to see the settings
        Route::get('/', [SettingsController::class, 'index'])->name('index');

        // The route to save/update the settings
        Route::post('/update', [SettingsController::class, 'update'])->name('update');

    });