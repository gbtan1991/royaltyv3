<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RedemptionFactory extends Factory
{
    public function definition(): array
    {
        $reward = Reward::inRandomOrder()->first() ?? Reward::factory()->create();

        return [
            'customer_id' => Customer::factory(),
            'reward_id'   => $reward->id,
            'redeemed_by' => User::factory(),
            'points_spent' => $reward->points_cost,
            'status'      => 'completed',
        ];
    }
}
