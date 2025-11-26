<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->unique()->userName(),
            'password_hash' => Hash::make('password123'), // default password
            'role' => fake()->randomElement(['superadmin', 'admin']),
            'status' => fake()->randomElement(['active', 'inactive', 'locked']),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'avatar' => null,
            'last_login_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'last_login_ip' => fake()->ipv4(),
            'login_attempts' => fake()->numberBetween(0, 5),
            'locked_until' => null,
            'password_reset_token' => null,
            'password_reset_sent_at' => null,
        ];

    }
}
