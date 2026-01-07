<?php 


use App\Http\Controllers\transaction\SalesTransactionController;

Route::middleware('auth:admin')
    ->prefix('transaction')
    ->name('transaction.')
    ->group(function() {
        

    Route::get('/', [SalesTransactionController::class, 'index'])->name('index');

    Route::get('/create', [SalesTransactionController::class, 'create'])->name('create');


    });

