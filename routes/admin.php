<?php

use App\Http\Controllers\admin\AdminController;

Route::prefix('admin')->name('admin.')->group(function () {

Route::resource('/', AdminController::class)
        ->parameters(['' => 'admin']); // Forces the variable in Controller to be $admin



});

