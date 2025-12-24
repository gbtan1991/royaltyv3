<?php

namespace App\Http\Requests\customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->role === 'Super Admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $customerId = $this->route('customer')->user_id;

        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],

            'member_id' => [
                'required', 
                'string', 
                'max:50', 
                'unique:customer_profile,member_id,' . $customerId . ',user_id'
            ],
            'loyalty_tier' => ['required', 'in:Bronze,Silver,Gold'],

            'is_active' => ['required', 'boolean'],

        ];
        
    }
}
