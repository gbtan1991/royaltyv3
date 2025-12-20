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
        return DB::transaction(function () use ($request) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'birth_date' => $request->birth_date,
                'gender' => $request->gender,
                'is_active' => true,
            ]);

            $user->adminProfile()->create([
                'employee_id' => $request->employee_id,
                'username' => $request->username,
                'password_hash' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'Active',
            ]);

            return redirect()->route('admin.index')
                ->with('success', "Admin {$user->first_name} created successfully.");
        });
        // Laravel automatically handles the Rollback if an Exception is thrown inside the closure.
    }


    /**
     * Display the specified admin's profile.
     * Uses Route Model Binding for AdminProfile.
     */
    public function show(AdminProfile $admin)
    {
        // Route Model Binding ensures $adminProfile is already loaded.
        // Eager load the user for display purposes
        $admin->load('user');

        // Renamed variable to avoid conflict if you use $admin in the view
        return view('admin.show', ['adminProfile' => $admin]);
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
