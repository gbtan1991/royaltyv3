<?php

use App\Livewire\Customers\CustomerList;
use App\Livewire\Customers\ManageCustomer;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    // Customers
    Route::get('/customers', CustomerList::class)->name('customers.index');
    Route::get('/customers/create', ManageCustomer::class)->name('customers.create');
    Route::get('/customers/{customer}/edit', ManageCustomer::class)->name('customers.edit');

    // Placeholder routes so sidebar links don't 404 yet (Phases 3-5)
    Route::get('/transactions', fn () => 'Coming in Phase 3')->name('transactions.index');
    Route::get('/rewards', fn () => 'Coming in Phase 4')->name('rewards.index');
    Route::get('/redemptions', fn () => 'Coming in Phase 4')->name('redemptions.index');
    Route::get('/settings', fn () => 'Coming in Phase 6')->name('settings.index');

});

require __DIR__.'/auth.php';
