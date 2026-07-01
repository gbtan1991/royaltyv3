<?php

use App\Livewire\Customers\CustomerList;
use App\Livewire\Customers\ManageCustomer;
use App\Livewire\Transactions\CreateTransaction;
use App\Livewire\Transactions\TransactionList;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::middleware(['auth'])->group(function () {

    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    // Customers
    Route::get('/customers', CustomerList::class)->name('customers.index');
    Route::get('/customers/create', ManageCustomer::class)->name('customers.create');
    Route::get('/customers/{customer}/edit', ManageCustomer::class)->name('customers.edit');

    // Transactions
    Route::get('/transactions', TransactionList::class)->name('transactions.index');
    Route::get('/transactions/create', CreateTransaction::class)->name('transactions.create');

    // Placeholder routes (Phases 4-6)
    Route::get('/rewards', fn () => 'Coming in Phase 4')->name('rewards.index');
    Route::get('/redemptions', fn () => 'Coming in Phase 4')->name('redemptions.index');
    Route::get('/settings', fn () => 'Coming in Phase 6')->name('settings.index');

});

require __DIR__.'/auth.php';
