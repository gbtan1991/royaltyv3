<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    public function run(): void
    {
        $rewards = [
            ['name' => 'Free Coffee',           'description' => 'Enjoy a complimentary cup of coffee.',        'points_cost' => 100,  'stock_quantity' => 50],
            ['name' => '10% Discount Voucher',  'description' => 'Get 10% off your next purchase.',             'points_cost' => 250,  'stock_quantity' => 30],
            ['name' => 'Free Dessert',          'description' => 'One free dessert of your choice.',            'points_cost' => 300,  'stock_quantity' => 25],
            ['name' => 'Birthday Treat',        'description' => 'A special treat on your birthday.',           'points_cost' => 500,  'stock_quantity' => 20],
            ['name' => 'VIP Lounge Access',     'description' => 'Access to our exclusive VIP lounge.',         'points_cost' => 1000, 'stock_quantity' => 10],
            ['name' => 'Free Shipping',         'description' => 'Free shipping on your next online order.',    'points_cost' => 150,  'stock_quantity' => 100],
            ['name' => 'Surprise Gift Box',     'description' => 'A curated box of goodies just for you.',      'points_cost' => 2000, 'stock_quantity' => 5],
        ];

        foreach ($rewards as $reward) {
            Reward::firstOrCreate(['name' => $reward['name']], array_merge($reward, ['is_active' => true]));
        }
    }
}
