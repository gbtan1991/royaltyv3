<?php

namespace App\Livewire\Redemptions;

use App\Models\Customer;
use App\Models\Redemption;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Redemptions')]
class RedemptionList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    #[Url(as: 'customer')]
    public string $customerFilter = '';

    public function updatingSearch(): void { $this->resetPage(); }
    public function updatingCustomerFilter(): void { $this->resetPage(); }

    public function render()
    {
        $redemptions = Redemption::query()
            ->with(['customer', 'reward', 'redeemedBy'])
            ->when($this->search, fn ($q) =>
                $q->whereHas('customer', fn ($q) =>
                    $q->where('first_name', 'like', "%{$this->search}%")
                      ->orWhere('last_name', 'like', "%{$this->search}%")
                      ->orWhere('member_number', 'like', "%{$this->search}%")
                )->orWhereHas('reward', fn ($q) =>
                    $q->where('name', 'like', "%{$this->search}%")
                )
            )
            ->when($this->customerFilter, fn ($q) =>
                $q->where('customer_id', $this->customerFilter)
            )
            ->orderByDesc('created_at')
            ->paginate(15);

        $customers = Customer::orderBy('first_name')->get(['id', 'first_name', 'last_name']);

        return view('livewire.redemptions.redemption-list', compact('redemptions', 'customers'));
    }
}
