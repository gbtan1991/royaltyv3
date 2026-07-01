<?php

namespace App\Livewire\Transactions;

use App\Models\Customer;
use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Transactions')]
class TransactionList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'customer')]
    public string $customerFilter = '';

    public ?int $confirmingDeleteId = null;

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingCustomerFilter(): void { $this->resetPage(); }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDeleteId = $id;
    }

    public function cancelDelete(): void
    {
        $this->confirmingDeleteId = null;
    }

    public function delete(): void
    {
        Transaction::findOrFail($this->confirmingDeleteId)->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Transaction deleted. Customer balance updated automatically.');
    }

    public function render()
    {
        $transactions = Transaction::query()
            ->with(['customer', 'recordedBy'])
            ->when($this->search, function ($q) {
                $q->whereHas('customer', fn ($q) =>
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('member_number', 'like', "%{$this->search}%")
                );
            })
            ->when($this->customerFilter, fn ($q) =>
                $q->where('customer_id', $this->customerFilter)
            )
            ->orderByDesc('transacted_at')
            ->paginate(15);

        $customers = Customer::orderBy('first_name')->get(['id', 'first_name', 'last_name']);

        return view('livewire.transactions.transaction-list', compact('transactions', 'customers'));
    }
}
