<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'points_per_unit'], [
            'value'       => '1',
            'description' => 'Points earned per 1 currency unit spent (e.g. 1 = 1 pt per ₱1, 0.01 = 1 pt per ₱100)',
        ]);

        Setting::updateOrCreate(['key' => 'app_name'], [
            'value'       => 'RoyaltyRewards',
            'description' => 'Display name of the application',
        ]);
    }
}
