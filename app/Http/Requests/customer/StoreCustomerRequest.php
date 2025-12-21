<?php

namespace App\Http\Requests\customer;


use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function authorize(): bool
    {

        return true;



    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       return [
        'first_name'   => ['required', 'string', 'max:255'],
        'last_name'    => ['required', 'string', 'max:255'],
        'birth_date'   => ['required', 'date'],
        'gender'       => ['required', 'in:Male,Female,Other'],
        
        // Update these to match your migration
        'member_id'    => ['required', 'integer', 'unique:customer_profile,member_id'],
        'loyalty_tier' => ['required', 'in:Bronze,Silver,Gold'], // No 'Platinum' in migration
        'status'       => ['required', 'in:Active,Inactive'], 
    ];
    }
}
