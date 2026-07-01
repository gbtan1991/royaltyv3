<?php

namespace App\Livewire\Customers\Forms;

use App\Models\Customer;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerFormData extends Form
{
    public ?Customer $customer = null;

    #[Validate('required|string|max:100')]
    public string $firstName = '';

    #[Validate('required|string|max:100')]
    public string $lastName = '';

    #[Validate('nullable|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:30')]
    public string $phone = '';

    #[Validate('required|in:bronze,silver,gold')]
    public string $loyaltyTier = 'bronze';

    #[Validate('boolean')]
    public bool $isActive = true;

    public function fill(Customer $customer): void
    {
        $this->customer   = $customer;
        $this->firstName  = $customer->first_name;
        $this->lastName   = $customer->last_name;
        $this->email      = $customer->email ?? '';
        $this->phone      = $customer->phone ?? '';
        $this->loyaltyTier = $customer->loyalty_tier;
        $this->isActive   = $customer->is_active;
    }

    public function store(int $createdBy): Customer
    {
        $this->validate();

        return Customer::create([
            'first_name'   => $this->firstName,
            'last_name'    => $this->lastName,
            'email'        => $this->email ?: null,
            'phone'        => $this->phone ?: null,
            'loyalty_tier' => $this->loyaltyTier,
            'is_active'    => $this->isActive,
            'created_by'   => $createdBy,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        // Unique email check: ignore this customer's own email
        $emailRule = $this->email
            ? 'unique:customers,email,' . $this->customer->id
            : null;

        if ($emailRule) {
            $this->validateOnly('email', ['email' => ['nullable', 'email', 'max:255', $emailRule]]);
        }

        $this->customer->update([
            'first_name'   => $this->firstName,
            'last_name'    => $this->lastName,
            'email'        => $this->email ?: null,
            'phone'        => $this->phone ?: null,
            'loyalty_tier' => $this->loyaltyTier,
            'is_active'    => $this->isActive,
        ]);
    }
}
