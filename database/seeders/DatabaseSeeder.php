<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminProfile;
use App\Models\CustomerProfile; // Assuming CustomerProfile model exists
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call all dedicated seeders to organize your seeding logic
        // This makes your main seeder clean and easy to read.
        $this->call([
            AdminProfileSeeder::class, // Now handles all admin creation
            CustomerProfileSeeder::class, // Assuming this file is ready
            SettingSeeder::class,
            
            // Add other core seeders here later
            // PointsEarningRuleSeeder::class, 
            // SalesTransactionSeeder::class,
        ]);
    }
}