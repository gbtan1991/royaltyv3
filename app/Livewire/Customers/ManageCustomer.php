<?php

namespace App\Livewire\Customers;

use App\Livewire\Customers\Forms\CustomerFormData;
use App\Models\Customer;
use Livewire\Attributes\Title;
use Livewire\Component;

class ManageCustomer extends Component
{
    public CustomerFormData $form;

    public ?Customer $customer = null;

    public function mount(?Customer $customer = null): void
    {
        $this->customer = $customer;

        if ($customer) {
            $this->form->fill($customer);
        }
    }

    #[Title('')]
    public function title(): string
    {
        return $this->customer ? 'Edit Customer' : 'Add Customer';
    }

    public function save(): void
    {
        if ($this->customer) {
            $this->form->update();
            session()->flash('success', 'Customer updated successfully.');
        } else {
            $this->form->store(auth()->id());
            session()->flash('success', 'Customer added successfully.');
        }

        $this->redirect(route('customers.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.customers.manage-customer')
            ->title($this->customer ? 'Edit Customer' : 'Add Customer');
    }
}
