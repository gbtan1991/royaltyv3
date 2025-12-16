<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\AdminProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Eager load the related User Data for Performance
        $admins = AdminProfile::with('user')->get();

        return view('admin.index', compact('admins'));
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created admin user and profile in storage.
     * Uses StoreAdminRequest for validation and authorization.
     */
   public function store(StoreAdminRequest $request): RedirectResponse
    {
        // Mandatory: Use a database transaction to ensure data integrity across two tables.
        try {
            DB::beginTransaction();

            // 1. Create the core User identity record
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date, // Assuming birth_date is in the request
                'gender' => $request->gender,
                'is_active' => true, 
                // access_key is left null for admin users
            ]);

            // 2. Create the associated Admin Profile record (Uses the User's relationship)
            $user->adminProfile()->create([
                'employee_id' => $request->employee_id,
                'username' => $request->username,
                'password_hash' => Hash::make($request->password), 
                'role' => $request->role, 
                'status' => 'Active',
            ]);
            
            DB::commit(); // Both records were created successfully

            return redirect()->route('admin.index')
                             ->with('success', 'New admin ' . $user->first_name . ' has been successfully created.');

        } catch (\Exception $e) {
            DB::rollBack(); // If anything failed, undo both User and AdminProfile creation
            
            // Log the error for internal debugging
            \Log::error("Failed to create new admin: " . $e->getMessage());
            
            return back()->withInput()
                         ->with('error', 'Failed to create the admin account due to a system error.');
        }
    }


   /**
     * Display the specified admin's profile.
     * Uses Route Model Binding for AdminProfile.
     */
    public function show(AdminProfile $adminProfile)
{
    // Route Model Binding ensures $adminProfile is already loaded.
    // Eager load the user for display purposes
    $adminProfile->load('user');

    // Renamed variable to avoid conflict if you use $admin in the view
        return view('admin.show', compact('adminProfile'));
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
