<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // Only Super Admins or managers should be able to create new admins
        return $this->user()->adminProfile->role === 'Super Admin';
    }

    
    public function rules(): array
    {
       return [
            // --- User Table Fields ---
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['nullable', Rule::in(['Male', 'Female', 'Other'])],
            
            // --- Admin Profile Fields ---
            'username' => ['required', 'string', 'max:50', 'unique:admin_profile,username'], // Unique on the admin_profile table
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'employee_id' => ['required', 'integer', 'unique:admin_profile,employee_id'],
            'role' => ['required', Rule::in(['Super Admin', 'Admin'])],
        ];
    }
}
