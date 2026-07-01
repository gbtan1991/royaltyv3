<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Redemption;
use App\Models\Reward;
use App\Models\User;
use Illuminate\Database\Seeder;

class RedemptionSeeder extends Seeder
{
    public function run(): void
    {
        $rewards = Reward::all();
        $admins  = User::all();

        // Give roughly half the customers at least one redemption
        $customers = Customer::inRandomOrder()->take(10)->get();

        foreach ($customers as $customer) {
            $balance = $customer->pointsBalance();
            $affordable = $rewards->where('points_cost', '<=', $balance);

            if ($affordable->isEmpty()) {
                continue;
            }

            $reward = $affordable->random();

            Redemption::create([
                'customer_id'  => $customer->id,
                'reward_id'    => $reward->id,
                'redeemed_by'  => $admins->random()->id,
                'points_spent' => $reward->points_cost,
                'status'       => 'completed',
            ]);
        }
    }
}
