<?php

namespace App\Http\Controllers\transaction;

use App\Models\User;
use App\Models\Rewards;
use App\Models\PointsLedger;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RedemptionController extends Controller
{
    // List all redemptions
    public function index()
    {
        $redemptions = PointsLedger::where('source_type', 'CLAIM')
            ->with(['customer.user'])
            ->latest('ledger_date')
            ->paginate(15);

        return view('transaction.redemption.index', compact('redemptions'));
    }

    public function create(Request $request)
    {
        $customer = null;
        $rewards = Rewards::where('is_active', true)->get();

        if ($request->filled('search')) {
            $search = $request->search;

            $user = User::where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', "%$search%")
                    ->orWhere('last_name', 'LIKE', "%$search%")
                    ->orWhere('access_key', $search);
            })
                ->has('customerProfile')
                ->first();

            if ($user) {
                $customer = $user->customerProfile;
                $customer->setRelation('user', $user);

                // --- THIS IS THE KEY PART ---
                // We sum the points_amount column for this specific user
                $customer->current_balance = PointsLedger::where('user_id', $user->id)
                    ->sum('points_amount');
            }
        }

        return view('transaction.redemption.create', compact('customer', 'rewards'));
    }
    // Process the claim
   public function store(Request $request)
{
    $request->validate([
        // Change 'id' to 'user_id'
        'customer_id' => 'required|exists:customer_profile,user_id', 
        'reward_id' => 'required|exists:rewards,id',
    ]);

    // Use findOrFail with the correct ID
    $customer = CustomerProfile::findOrFail($request->customer_id);
    $reward = Rewards::findOrFail($request->reward_id);

    // Calculate balance from Ledger (since we aren't using a cached column)
    $currentBalance = PointsLedger::where('user_id', $customer->user_id)->sum('points_amount');

    if ($currentBalance < $reward->points_cost) {
        return back()->with('error', 'Insufficient points.');
    }

    if ($reward->stock_quantity <= 0) {
        return back()->with('error', 'Out of stock.');
    }

    DB::transaction(function () use ($customer, $reward) {
        PointsLedger::create([
            'user_id' => $customer->user_id,
            'points_amount' => -$reward->points_cost,
            'source_type' => 'CLAIM',
            'source_id' => $reward->id,
            'description' => "Redeemed: {$reward->name}",
            'ledger_date' => now(),
        ]);

        $reward->decrement('stock_quantity');
    });

    return redirect()->route('redemption.index')->with('success', 'Reward claimed successfully!');
}
}