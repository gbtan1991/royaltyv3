<?php

use App\Livewire\Customers\CustomerList;
use App\Livewire\Customers\ManageCustomer;
use App\Livewire\Redemptions\CreateRedemption;
use App\Livewire\Redemptions\RedemptionList;
use App\Livewire\Rewards\ManageReward;
use App\Livewire\Rewards\RewardList;
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

    // Rewards
    Route::get('/rewards', RewardList::class)->name('rewards.index');
    Route::get('/rewards/create', ManageReward::class)->name('rewards.create');
    Route::get('/rewards/{reward}/edit', ManageReward::class)->name('rewards.edit');

    // Redemptions
    Route::get('/redemptions', RedemptionList::class)->name('redemptions.index');
    Route::get('/redemptions/create', CreateRedemption::class)->name('redemptions.create');

    // Placeholder (Phase 6)
    Route::get('/settings', fn () => 'Coming in Phase 6')->name('settings.index');

});

require __DIR__.'/auth.php';
