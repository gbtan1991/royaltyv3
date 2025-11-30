<?php 

use App\Http\Controllers\admin\AdminController;

Route::middleware('auth:admin')   // << apply alias here
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin index page (list of admins)
        Route::get('/', [AdminController::class, 'index'])->name('index');

        // Show form to create new admin
        Route::get('/create', [AdminController::class, 'create'])->name('create');

        // Store new admin
        Route::post('/', [AdminController::class, 'store'])->name('store');

        // Show form to edit existing admin
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit');

        // Update existing admin
        Route::put('/{admin}', [AdminController::class, 'update'])->name('update');

        // Delete existing admin
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy');

        // Optional: show single admin (if needed)
        Route::get('/{admin}', [AdminController::class, 'show'])->name('show');
    });