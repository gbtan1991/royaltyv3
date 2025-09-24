<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::paginate(10);
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'      => 'required|string|unique:admins,username',
            'password'      => 'required|string|min:6|confirmed',
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'birthdate'     => 'nullable|date',
            'account_type'  => 'required|in:admin,superadmin',
            'avatar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('avatar')){
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
         }
        
        
        Admin::create($validated);

        return redirect()->route('admin.index')->with('success', 'Admin has been added successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return view('admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
         $validated = $request->validate([
            'username'      => 'required|string|unique:admins,username,' . $admin->id,
            'first_name'    => 'required|string|max:255',
            'last_name'     => 'required|string|max:255',
            'birthdate'     => 'nullable|date',
            'account_type'  => 'required|in:admin,superadmin',
            'avatar'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($request->filled('password')){
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
            ]);
            $validated['password'] = $request->password;
        }

        if ($request->hasFile('avatar')){
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $admin->update($validated);

        return redirect()->route('admin.index')->with('success', 'Admin has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return redirect()->route('admin.index')->with('success', 'Admin has been deleted successfully.');

    }
}
