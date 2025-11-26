<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create 5 admin accounts
        Admin::factory()->count(5)->create();

        // Optional: Create a guaranteed superadmin account
        Admin::factory()->create([
            'username' => 'superadmin',
            'password_hash' => bcrypt('supersecurepassword'),
            'role' => 'superadmin',
            'status' => 'active',
        ]);
    }
}
