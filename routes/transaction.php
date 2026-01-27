<?php


use App\Http\Controllers\transaction\RedemptionController;
use App\Http\Controllers\transaction\PointsLedgerController;
use App\Http\Controllers\transaction\SalesTransactionController;


Route::prefix('transaction')->name('transaction.')->group(function () {

    // 1. Specific route FIRST
    Route::get('/ledger', [PointsLedgerController::class, 'index'])->name('ledger.index');

    // 2. Resource (Dynamic/Wildcard) LAST
    Route::resource('/', SalesTransactionController::class)
        ->parameters(['' => 'transaction']); 

});

Route::prefix('redemption')->name('redemption.')->group(function () {
    // This makes the URL: /redemption
    Route::get('/', [RedemptionController::class, 'index'])->name('index');

    // This makes the URL: /redemption/create
    Route::get('/create', [RedemptionController::class, 'create'])->name('create');

    // This makes the URL: /redemption/claim
    Route::post('/claim', [RedemptionController::class, 'store'])->name('store');

    Route::get('/{id}', [RedemptionController::class, 'show'])->name('show');
});
