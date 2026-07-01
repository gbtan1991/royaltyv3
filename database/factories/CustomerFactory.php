<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name'    => fake()->firstName(),
            'last_name'     => fake()->lastName(),
            'email'         => fake()->unique()->safeEmail(),
            'phone'         => fake()->phoneNumber(),
            'member_number' => strtoupper('MBR-' . fake()->unique()->numerify('######')),
            'loyalty_tier'  => fake()->randomElement(['bronze', 'silver', 'gold']),
            'is_active'     => true,
        ];
    }
}
