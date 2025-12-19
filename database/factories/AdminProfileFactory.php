<?php

namespace Database\Factories;

use App\Models\AdminProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // The user_id will be set automatically by the afterCreating callback below
            'employee_id' => $this->faker->unique()->numberBetween(1000, 9999),
            'username' => $this->faker->unique()->userName(),
            // Secure default password for testing
            'password_hash' => Hash::make('password'), 
            'role' => $this->faker->randomElement(['Super Admin', 'Admin']),
            'status' => $this->faker->randomElement(['active', 'suspended', 'deactivated']),
            'last_login_at' => null,
        ];
    }

   

    /**
     * State for a Super Admin role.
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'superadmin',
        ]);
    }
}