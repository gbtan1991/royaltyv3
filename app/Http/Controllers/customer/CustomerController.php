<?php

namespace App\Http\Controllers\customer;

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
