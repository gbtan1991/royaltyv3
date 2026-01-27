<?php

namespace App\Http\Controllers\transaction;

use App\Models\User;
use App\Models\Rewards;
use App\Models\Redemption;
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
    // DEBUG 1: See if the request is even hitting the controller
    // dd($request->all()); 

    $request->validate([
        'customer_id' => 'required|exists:customer_profile,user_id',
        'reward_id'   => 'required|exists:rewards,id',
    ]);

    $customer = CustomerProfile::where('user_id', $request->customer_id)->firstOrFail();
    $reward   = Rewards::findOrFail($request->reward_id);

    // DEBUG 2: Check if points calculation is working
    $currentBalance = PointsLedger::where('user_id', $customer->user_id)->sum('points_amount');
    
    if ($currentBalance < $reward->points_cost) {
        return back()->with('error', "Insufficient points. Needs {$reward->points_cost}, has {$currentBalance}");
    }

    try {
        DB::beginTransaction();

        $redemption = Redemption::create([
            'customer_user_id' => $customer->user_id,
            'reward_id'        => $reward->id,
            'points_spent'     => $reward->points_cost,
            'status'           => 'completed',
        ]);

        PointsLedger::create([
            'user_id'       => $customer->user_id,
            'points_amount' => -$reward->points_cost,
            'source_type'   => 'CLAIM',
            'source_id'     => $redemption->id,
            'description'   => "Redeemed Reward: {$reward->name}",
            'ledger_date'   => now(),
        ]);

        $reward->decrement('stock_quantity');

        DB::commit();
        
        return redirect()->route('redemption.index')->with('success', 'Claimed!');

    } catch (\Exception $e) {
        DB::rollBack();
        // This will FORCE the error to show on screen even if your blade isn't showing alerts
        dd("Transaction Failed: " . $e->getMessage()); 
    }
}
    public function show($id)
    {
        // We fetch the ledger entry specifically for this claim
        // and load the user and reward details
        $redemption = Redemption::with(['user.customerProfile', 'reward'])
        ->findOrFail($id);

        return view('transaction.redemption.show', compact('redemption'));
    }
}