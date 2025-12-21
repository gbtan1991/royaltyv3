<?php

use App\Http\Controllers\customer\CustomerController;

Route::middleware('auth:admin')
    ->prefix('customer')
    ->name('customer.')
    ->group(function() {


        Route::get('/customers', [CustomerController::class, 'index'])->name('index');

        Route::get('/customers/create', [CustomerController::class, 'create'])->name('create');

        Route::post('/customers', [CustomerController::class, 'store'])->name('store');

    });

