<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'username' => 'superadmin',
            'password' => Hash::make('password123'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'avatar' => 'images/avatars/avatar1.png',
            'admin_type' => 'super_admin',
            'account_status' => 'active',
            'last_login_at' => now(),
        ]);

        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'first_name' => 'Regular',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'admin_type' => 'admin',
            'account_status' => 'active',
            'last_login_at' => now(),
        ]);
    }
}
