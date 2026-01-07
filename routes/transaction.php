<?php 


use App\Http\Controllers\transaction\SalesTransactionController;

Route::middleware('auth:admin')
    ->prefix('transactions')
    ->name('transactions.')
    ->group(function() {
        

    Route::get('/transactions', [SalesTransactionController::class, 'index'])->name('index');


    });

