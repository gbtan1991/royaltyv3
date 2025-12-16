<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CustomerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1.  Create 450 regular customers
        User::factory()->count(450)
             ->has(CustomerProfile::factory()) 
             ->create();
             
    }
}