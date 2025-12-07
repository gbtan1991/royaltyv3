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
        $name = fake()->firstName() . ' ' . fake()->lastName();

        return [
            'username' => fake()->unique()->userName(),
            'password_hash' => bcrypt('password123'), // default password
            'role' => fake()->randomElement(['superadmin', 'admin']),
            'status' => fake()->randomElement(['active', 'inactive', 'locked']),
            
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),

            'last_login_at' => null,
            'last_login_ip' => null,
            'login_attempts' => 0,
            'locked_until' => null,
            'password_reset_token' => null,
            'password_reset_sent_at' => null,
        ];
    }
}
