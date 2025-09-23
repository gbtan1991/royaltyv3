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
        Admin::create([
            'username'       => 'superadmin',
            'password'       => 'superadmin123', // auto-hashed by mutator
            'first_name'     => 'Super',
            'last_name'      => 'Admin',
            'birthdate'      => '1990-01-01',
            'account_type'   => 'superadmin',
            'account_status' => 'active',
            'avatar'         => null,
        ]);

        Admin::create([
            'username'       => 'adminuser',
            'password'       => 'admin123', // auto-hashed by mutator
            'first_name'     => 'Regular',
            'last_name'      => 'Admin',
            'birthdate'      => '1995-01-01',
            'account_type'   => 'admin',
            'account_status' => 'active',
            'avatar'         => null,
        ]);
    }
}
