<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'username'       => 'superadmin',
            'password'       => Hash::make('secret123'), // 🔑 change this later
            'first_name'     => 'System',
            'last_name'      => 'Administrator',
            'avatar'         => null, // or provide a default path
            'account_status' => 'active',
            'admin_role'     => 'superadmin',
        ]);
    }
}
