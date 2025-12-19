<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AdminProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a specific, known Super Admin account for testing.
        
        // A. Create the parent User identity record.
        $superAdminUser = User::factory()->create([
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'gender' => 'other',
            'is_active' => true,
        ]);

        // B. Create the linked AdminProfile record using the created User's ID.
        AdminProfile::factory()->create([
            'user_id' => $superAdminUser->id,
            'employee_id' => 100, // Fixed ID for easy reference
            'username' => 'superadmin',
            // Use Hash::make() for secure password storage
            'password_hash' => Hash::make('supersecurepassword'), 
            'role' => 'Super Admin', // Must match ENUM exactly
            'status' => 'active',    // Must match ENUM exactly
        ]);

        // 2. Create 20 random admin accounts using the 'has' relationship helper.
        // This creates 20 User records, and attaches one AdminProfile to each.
        User::factory()->count(20)
             // The method name 'adminProfile' must match the HasOne relationship in App\Models\User.php
            ->has(AdminProfile::factory()) 
            ->create();
    }
}