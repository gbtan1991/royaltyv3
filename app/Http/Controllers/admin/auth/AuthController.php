<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Http\Controllers\Controller;
class AuthController extends Controller
{


    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
     [
                'username' => 'required|string|max:255',
                'password' => 'required|string|max:255',
            ]);

            //Admin to login using custom admin guard
            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                
                //Optional: check if the account is approved
               if($admin->account_status !== 'active'){
                    Auth::guard('admin')->logout();
                    return redirect()->back()->withErrors([
                        'account' => 'Your account is not approved yet. Please contact the Super Admin for approval.'
                    ]);
               }
            
               //Update last login timestamp
               $admin->update(['last_login' => now()]);

               //Redirect to dashboard
               return redirect()->route('dashboard');
            }

            //If authentication fails
            return back()->withErrors([
                'login' => 'Invalid username or password.',
            ])->withInput();

    }


    public function showRegister()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:8',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
        ]);

        $admin = Admin::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'admin_type' => 'super_admin', // Default admin type
            'account_status' => 'pending', // Default account status
        ]);

    return redirect()->route('admin.confirmation', ['username' => $admin->username]);

    }


    public function logout(Request $request) 
    {
        Auth::guard('admin')->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
