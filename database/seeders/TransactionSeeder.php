<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Transaction;
use App\Models\User;
use App\Services\PointsCalculator;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $calculator = new PointsCalculator();
        $customers  = Customer::all();
        $admins     = User::all();

        foreach ($customers as $customer) {
            // Give each customer between 3 and 15 transactions for varied histories
            $count = rand(3, 15);

            for ($i = 0; $i < $count; $i++) {
                $amount = fake()->randomFloat(2, 50, 5000);

                Transaction::create([
                    'customer_id'   => $customer->id,
                    'recorded_by'   => $admins->random()->id,
                    'amount'        => $amount,
                    'points_earned' => $calculator->calculate($amount),
                    'transacted_at' => fake()->dateTimeBetween('-1 year', 'now'),
                ]);
            }
        }
    }
}
