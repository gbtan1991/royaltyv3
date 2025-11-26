<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'total_points' => $this->faker->numberBetween(0, 5000),
        ];
    }
}
