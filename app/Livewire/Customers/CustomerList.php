<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Customers')]
class CustomerList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public ?int $confirmingDeleteId = null;
    public ?string $deleteError = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDeleteId = $id;
        $this->deleteError = null;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
        $this->deleteError = null;
    }

    public function delete(): void
    {
        $customer = Customer::findOrFail($this->confirmingDeleteId);

        if ($customer->transactions()->exists() || $customer->redemptions()->exists()) {
            $this->deleteError = 'This customer has transaction history and cannot be deleted. Deactivate them instead.';
            return;
        }

        $customer->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Customer deleted.');
    }

    public function render()
    {
        $customers = Customer::query()
            ->when($this->search, function ($q) {
                $q->where(function ($q) {
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('email', 'like', "%{$this->search}%")
                      ->orWhere('member_number', 'like', "%{$this->search}%");
                });
            })
            ->withCount(['transactions', 'redemptions'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('livewire.customers.customer-list', compact('customers'));
    }
}
