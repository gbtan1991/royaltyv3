<?php


use App\Http\Controllers\transaction\PointsLedgerController;
use App\Http\Controllers\transaction\SalesTransactionController;

Route::middleware('auth:admin')
    ->prefix('transaction')
    ->name('transaction.')
    ->group(function () {


        Route::get('/ledger', [PointsLedgerController::class, 'index'])->name('ledger.index');
        Route::get('/', [SalesTransactionController::class, 'index'])->name('index');
        Route::get('/create', [SalesTransactionController::class, 'create'])->name('create');



        Route::post('/store', [SalesTransactionController::class, 'store'])->name('store');
        Route::get('/{transaction}', [SalesTransactionController::class, 'show'])->name('show');
        Route::get('/{transaction}/edit', [SalesTransactionController::class, 'edit'])->name('edit');
        Route::put('/{transaction}', [SalesTransactionController::class, 'update'])->name('update');

        Route::delete('/{transaction}', [SalesTransactionController::class, 'destroy'])->name('destroy');



    });

