<?php 


use App\Http\Controllers\transaction\SalesTransactionController;

Route::middleware('auth:admin')
    ->prefix('transaction')
    ->name('transaction.')
    ->group(function() {
        

    Route::get('/', [SalesTransactionController::class, 'index'])->name('index');

    Route::get('/create', [SalesTransactionController::class, 'create'])->name('create');
    
    Route::post('/store', [SalesTransactionController::class, 'store'])->name('store');

    Route::get('/show', [SalesTransactionController::class, 'show'])->name('show');

    Route::get('/edit', [SalesTransactionController::class, 'edit'])->name('edit');

    Route::delete('/delete', [SalesTransactionController::class, 'destroy'])->name('delete');


    });

