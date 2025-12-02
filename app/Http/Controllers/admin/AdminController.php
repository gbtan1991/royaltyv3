<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // Validate input
    $validated = $request->validate([
    'username'      => 'required|string|max:255|unique:admins,username',
    'password'      => 'required|string|min:8',
    'role'          => 'required|in:superadmin,admin',
    'status'        => 'required|in:active,inactive,locked',

    'first_name'    => 'nullable|string|max:255',
    'last_name'     => 'nullable|string|max:255',
    'avatar'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
]);

    // Handle avatar upload
    $avatarPath = null;
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars/admins', 'public');
    }

    // Create admin
    $admin = \App\Models\Admin::create([
        'username'      => $validated['username'],
        'password_hash' => bcrypt($validated['password']), // Store hashed
        'role'          => $validated['role'],
        'status'        => $validated['status'],

        'first_name'    => $validated['first_name'] ?? null,
        'last_name'     => $validated['last_name'] ?? null,
        'avatar'        => $avatarPath,

        // Security fields — intentionally left null
        'last_login_at' => null,
        'last_login_ip' => null,
        'login_attempts' => 0,
        'locked_until' => null,
        'password_reset_token' => null,
        'password_reset_sent_at' => null,
    ]);

    return redirect()
        ->route('admin.index')
        ->with('success', 'Admin user created successfully.');
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
