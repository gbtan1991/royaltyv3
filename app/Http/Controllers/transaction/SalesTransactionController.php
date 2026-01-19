<?php

namespace App\Http\Controllers\transaction;

use App\Models\AdminProfile;
use App\Models\PointsLedger;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use App\Models\SalesTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = SalesTransaction::with(['customer', 'admin', 'pointsLedger'])->latest()->paginate(15);

        return view('transaction.sales.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = CustomerProfile::with('user')->get();

        return view('transaction.sales.create', compact('customers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Match the field name to your migration/form
        $request->validate([
            'customer_user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ]);

        try {
            return DB::transaction(function () use ($request) {

                $pointsToEarn = floor($request->amount / 5);

                // 2. Create Sales Record
                $sales = SalesTransaction::create([
                    'customer_user_id' => $request->customer_user_id,
                    'admin_user_id' => auth('admin')->id(),
                    'amount' => $request->amount,
                ]);

                // 3. Create ledger entry
                if ($pointsToEarn > 0) {
                    $ledger = PointsLedger::create([
                        'user_id' => $request->customer_user_id,
                        'points_amount' => $pointsToEarn,
                        'source_type' => 'TRANSACTION',
                        'source_id' => $sales->id,
                        'description' => 'Earned from rental payment of PHP ' . number_format($request->amount, 2),
                    ]);

                    $sales->update(['points_ledger_id' => $ledger->id]);
                }

                // 4. FIX: Don't call relationships on the ID. 
                // Either fetch the user first or just use the ID in the message.
                return redirect()->route('transaction.index')
                    ->with('success', "Transaction complete! Points earned: {$pointsToEarn}");
            });
        } catch (\Exception $e) {
            // This will now catch the error and show you EXACTLY what is wrong
            return back()->with('error', 'Transaction failed: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(SalesTransaction $transaction)
    {
        // Now that the route has {transaction}, Laravel will find the 
        // real data and this 'load' will actually have something to work with.
        $transaction->load(['customer.customerProfile', 'admin', 'pointsLedger']);

        return view('transaction.sales.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalesTransaction $transaction)
    {
        // Load relationships to show current  customer infor in the form
        $transaction->load('customer');

        return view('transaction.sales.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, SalesTransaction $transaction)
{
    $request->validate([
        'amount' => 'required|numeric|min:0',
        'transaction_date' => 'required|date',
    ]);

    DB::transaction(function () use ($request, $transaction) {
        // 1. Update the Sales Transaction
        $transaction->update([
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
        ]);

        // 2. Recalculate Points (Adjust the logic to your needs)
        // If 1 point per 10 PHP:
        $newPoints = floor($request->amount / 5); 
        
        // 3. Update the existing Ledger entry linked to this transaction
        // We find the ledger entry where source_id = $transaction->id
        $ledger = PointsLedger::where('source_id', $transaction->id)
                    ->where('source_type', 'TRANSACTION')
                    ->first();

        if ($ledger) {
            $ledger->update([
                'points_amount' => $newPoints,
                'description' => "Updated points for Transaction #{$transaction->id} (Amount: PHP " . number_format($request->amount, 2) . ")"
            ]);
        }
    });

    return redirect()->route('transaction.show', $transaction)
        ->with('success', 'Transaction and points updated successfully.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalesTransaction $transaction)
    {
        try {
            DB::transaction(function () use ($transaction) {
                // 1. Delete associated points first (if they exist)
                if ($transaction->pointsLedger) {
                    $transaction->pointsLedger->delete();
                }

                // 2. Delete the transaction itself
                $transaction->delete();
            });

            return redirect()->route('transaction.index')
                ->with('success', 'Transaction and associated points deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to delete transaction: ' . $e->getMessage());
        }
    }
}
