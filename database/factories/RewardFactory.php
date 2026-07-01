<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RewardFactory extends Factory
{
    public function definition(): array
    {
        $rewards = [
            ['Free Coffee', 'Enjoy a complimentary cup of coffee.'],
            ['10% Discount Voucher', 'Get 10% off your next purchase.'],
            ['Free Dessert', 'One free dessert of your choice.'],
            ['Birthday Treat', 'A special treat on your birthday.'],
            ['VIP Lounge Access', 'Access to our exclusive VIP lounge for one visit.'],
            ['Free Shipping', 'Free shipping on your next online order.'],
            ['Surprise Gift Box', 'A curated box of goodies just for you.'],
        ];

        [$name, $description] = fake()->randomElement($rewards);

        return [
            'name'           => $name,
            'description'    => $description,
            'points_cost'    => fake()->randomElement([100, 250, 500, 750, 1000, 2000, 5000]),
            'stock_quantity' => fake()->numberBetween(5, 50),
            'is_active'      => true,
        ];
    }
}
