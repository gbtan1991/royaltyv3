<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            // Ensure the gender case matches your migration ('male', 'female', 'other')
            'gender' => $this->faker->randomElement(['male', 'female', 'other']), 
            'birth_date' => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            
            'is_active' => true,
            'access_key' => null,
        ];
    }
}