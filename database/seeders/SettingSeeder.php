<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Settings;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Settings::updateOrCreate(
            ['key' => 'points_ratio'], // Search for this
            [
                'value' => '10', 
                'description' => 'Amount of PHP spent to earn 1 loyalty point.'
            ]
        );

        // You can add more settings here later, like:
        // Setting::updateOrCreate(['key' => 'min_redemption_points'], ['value' => '100']);
    }
}