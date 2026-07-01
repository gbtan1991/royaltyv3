<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $admins = User::all();

        Customer::factory(20)->create([
            'created_by' => fn () => $admins->random()->id,
        ]);
    }
}
