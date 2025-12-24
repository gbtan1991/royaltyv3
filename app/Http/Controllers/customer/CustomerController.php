<?php

namespace App\Http\Controllers\customer;

use App\Http\Requests\customer\UpdateCustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\customer\StoreCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = CustomerProfile::with('user')->get();

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        try {
            // Start transaction to ensure data integrity
            DB::beginTransaction();

            // 1. Create the Core User Identity
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'birth_date' => $request->birth_date,
                'gender'     => $request->gender,
                'is_active'  => true, // Defaulting to active
            ]);

            // 2. Create the Customer Profile linked to this User
            // We use the relationship defined in your User model
            $user->customerProfile()->create([
                'member_id'                   => $request->member_id,
                'loyalty_tier'                => $request->loyalty_tier,
                'registered_by_admin_user_id' => auth()->id(), // Captures the current Admin
                'last_activity_at'            => now(),
            ]);

            DB::commit();

            return redirect()->route('customer.index')
                ->with('success', "Customer {$user->full_name} registered successfully!");

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error so you can debug it in storage/logs/laravel.log
            Log::error("Customer Registration Failed: " . $e->getMessage());

            return back()
                ->with('error', 'Failed to register customer. Please check the logs.')
                ->withInput(); // Keeps the form data so the admin doesn't re-type it
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerProfile $customer)
    {
        $customer->load('user');

        return view('customer.show', ['customer' => $customer]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerProfile $customer)
    {
        $customer->load('user');

        return view('customer.edit', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(UpdateCustomerRequest $request, CustomerProfile $customer)
{
    try {
        DB::beginTransaction();

        // Ensure the user relationship is loaded
        $user = $customer->user;

        // 1. Update the User (Identity)
        $user->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'gender'     => strtolower($request->gender), // Force lowercase to match migration
            'birth_date' => $request->birth_date,
            'is_active'  => $request->is_active,
        ]);

        // 2. Update the Profile (Loyalty)
        $customer->update([
            'loyalty_tier' => $request->loyalty_tier,
            'member_id'    => $request->member_id, 
        ]);

        DB::commit();

        return redirect()->route('customer.index')
                         ->with('success', "Customer {$user->first_name} updated successfully!");

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error("Update error: " . $e->getMessage());
        return back()->with('error', 'Update failed: ' . $e->getMessage())->withInput();
    }
}   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerProfile $customer)
    {
        try{
            DB::beginTransaction();

            $user = $customer->user;
            $customer->delete();
            $user->delete();

            DB::commit();

            return redirect()->route('customer.index')
                ->with('success', "Customer {$user->full_name} deleted successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to delete customer: " . $e->getMessage());

            return back()->with('error', 'Deletion failed due to a system error.');
        }
    }
}
