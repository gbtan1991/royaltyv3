<?php

namespace Database\Factories;

use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // The user_id is automatically set when called via User::factory()->has(...)
            'member_id' => $this->faker->unique()->numberBetween(100000, 999999),
            'loyalty_tier' => $this->faker->randomElement(['Bronze', 'Silver']),    
            'last_activity_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
   
}