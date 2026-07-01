<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            AdminSeeder::class,
            CustomerSeeder::class,
            RewardSeeder::class,
            TransactionSeeder::class,
            RedemptionSeeder::class,
        ]);
    }
}
