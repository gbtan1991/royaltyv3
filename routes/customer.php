<?php

use App\Http\Controllers\customer\CustomerController;

Route::prefix('customer')->name('customer.')->group(function () {


    Route::resource('/', CustomerController::class)
        ->parameters(['' => 'customer']); // Forces the variable in Controller to be $customer



});

