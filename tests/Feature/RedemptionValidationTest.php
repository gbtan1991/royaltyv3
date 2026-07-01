<?php

use App\Models\Customer;
use App\Models\Redemption;
use App\Models\Reward;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Setting;
use Livewire\Livewire;
use App\Livewire\Redemptions\CreateRedemption;

beforeEach(function () {
    Setting::set('points_per_unit', 1);

    $this->admin = User::factory()->create();
    $this->actingAs($this->admin);
});

it('rejects a redemption when the customer has insufficient points', function () {
    $customer = Customer::factory()->create();
    $reward   = Reward::factory()->create(['points_cost' => 500, 'stock_quantity' => 10]);

    // Customer has 0 points — no transactions

    $component = Livewire::test(CreateRedemption::class);
    $component->call('selectCustomer', $customer->id, $customer->full_name);
    $component->set('reward_id', $reward->id);
    $component->call('save');

    $component->assertHasErrors(['customer_id']);
    expect(Redemption::count())->toBe(0);
});

it('rejects a redemption when the reward is out of stock', function () {
    $customer = Customer::factory()->create();
    Transaction::factory()->create(['customer_id' => $customer->id, 'points_earned' => 1000]);
    $reward = Reward::factory()->create(['points_cost' => 100, 'stock_quantity' => 0]);

    $component = Livewire::test(CreateRedemption::class);
    $component->call('selectCustomer', $customer->id, $customer->full_name);
    $component->set('reward_id', $reward->id);
    $component->call('save');

    $component->assertHasErrors(['reward_id']);
    expect(Redemption::count())->toBe(0);
});

it('creates a redemption and decrements stock when everything is valid', function () {
    $customer = Customer::factory()->create();
    Transaction::factory()->create(['customer_id' => $customer->id, 'points_earned' => 1000]);
    $reward = Reward::factory()->create(['points_cost' => 200, 'stock_quantity' => 5]);

    $component = Livewire::test(CreateRedemption::class);
    $component->call('selectCustomer', $customer->id, $customer->full_name);
    $component->set('reward_id', $reward->id);
    $component->call('save');

    $component->assertHasNoErrors();
    expect(Redemption::count())->toBe(1);
    expect($reward->fresh()->stock_quantity)->toBe(4);
});

it('deducts points from the customer balance after redemption', function () {
    $customer = Customer::factory()->create();
    Transaction::factory()->create(['customer_id' => $customer->id, 'points_earned' => 1000]);
    $reward = Reward::factory()->create(['points_cost' => 300, 'stock_quantity' => 5]);

    Livewire::test(CreateRedemption::class)
        ->call('selectCustomer', $customer->id, $customer->full_name)
        ->set('reward_id', $reward->id)
        ->call('save');

    expect($customer->pointsBalance())->toBe(700);
});

it('requires a customer to be selected before saving', function () {
    $reward = Reward::factory()->create(['points_cost' => 100, 'stock_quantity' => 5]);

    Livewire::test(CreateRedemption::class)
        ->set('reward_id', $reward->id)
        ->call('save')
        ->assertHasErrors(['customer_id']);
});

it('requires a reward to be selected before saving', function () {
    $customer = Customer::factory()->create();
    Transaction::factory()->create(['customer_id' => $customer->id, 'points_earned' => 1000]);

    Livewire::test(CreateRedemption::class)
        ->call('selectCustomer', $customer->id, $customer->full_name)
        ->call('save')
        ->assertHasErrors(['reward_id']);
});
