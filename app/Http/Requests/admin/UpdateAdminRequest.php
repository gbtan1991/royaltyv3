<?php

namespace App\Http\Requests\admin;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        
        return $this->user()?->role === 'Super Admin';

    }

    public function rules(): array
    {

        $adminId = $this->route('admin')->user_id;
        return [
        
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:Male,Female,Other'],

        // Correct Syntax: unique:TABLE_NAME,COLUMN_NAME,IGNORE_ID,ID_COLUMN
        'username' => [
            'required', 
            Rule::unique('admin_profile', 'username')->ignore($adminId, 'user_id')
        ],
        'employee_id' => [
            'required', 
            Rule::unique('admin_profile', 'employee_id')->ignore($adminId, 'user_id')
        ],

        
            'role' => ['required', 'in:Super Admin,Admin'],
            'status' => ['required', 'in:Active,Suspended,Deactivated'],

            'password' => ['nullable', 'string', 'min:8', 'confirmed'],

        ];
    }
}
