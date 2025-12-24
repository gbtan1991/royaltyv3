<?php

use App\Http\Controllers\customer\CustomerController;

Route::middleware('auth:admin')
    ->prefix('customer')
    ->name('customer.')
    ->group(function() {


        Route::get('/customer', [CustomerController::class, 'index'])->name('index');

        Route::get('/customer/create', [CustomerController::class, 'create'])->name('create');

        Route::post('/customer', [CustomerController::class, 'store'])->name('store');

        Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');

        Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('edit');

        Route::put('/{customer}', [CustomerController::class, 'update'])->name('update'); 
        
        Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('destroy');

    });

