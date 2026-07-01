<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@royalty.test'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        // Extra admin accounts for testing
        User::factory(2)->create();
    }
}
