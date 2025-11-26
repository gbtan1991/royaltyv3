<?php 


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\admin\AdminController::class, 'index'])->name('index');
    

});