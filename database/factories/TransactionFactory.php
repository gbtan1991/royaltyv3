<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 50, 5000);

        return [
            'customer_id'   => Customer::factory(),
            'recorded_by'   => User::factory(),
            'amount'        => $amount,
            'points_earned' => (int) floor($amount * 1), // default rate of 1 pt per unit
            'transacted_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
