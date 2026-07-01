<?php

namespace App\Livewire\Transactions;

use App\Models\Customer;
use App\Models\Transaction;
use App\Services\PointsCalculator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Record Transaction')]
class CreateTransaction extends Component
{
    // Customer search/select
    public string $customerSearch = '';
    public ?int $customerId = null;
    public string $selectedCustomerName = '';
    public bool $showDropdown = false;

    #[Validate('required|exists:customers,id')]
    public ?int $customer_id = null;

    #[Validate('required|numeric|min:0.01|max:999999.99')]
    public string $amount = '';

    public int $pointsPreview = 0;

    private PointsCalculator $calculator;

    public function boot(PointsCalculator $calculator): void
    {
        $this->calculator = $calculator;
    }

    public function updatedAmount(): void
    {
        $val = (float) $this->amount;
        $this->pointsPreview = $val > 0 ? $this->calculator->calculate($val) : 0;
    }

    public function updatedCustomerSearch(): void
    {
        $this->showDropdown = strlen($this->customerSearch) > 0;
        // Clear selection if the user edits the name field
        if ($this->selectedCustomerName !== $this->customerSearch) {
            $this->customer_id = null;
            $this->selectedCustomerName = '';
        }
    }

    public function selectCustomer(int $id, string $name): void
    {
        $this->customer_id = $id;
        $this->customerSearch = $name;
        $this->selectedCustomerName = $name;
        $this->showDropdown = false;
    }

    public function clearCustomer(): void
    {
        $this->customer_id = null;
        $this->customerSearch = '';
        $this->selectedCustomerName = '';
        $this->showDropdown = false;
    }

    #[Computed]
    public function customerResults(): \Illuminate\Support\Collection
    {
        if (strlen($this->customerSearch) < 1) {
            return collect();
        }

        return Customer::where('is_active', true)
            ->where(fn ($q) =>
                $q->where('first_name', 'like', "%{$this->customerSearch}%")
                  ->orWhere('last_name', 'like', "%{$this->customerSearch}%")
                  ->orWhere('member_number', 'like', "%{$this->customerSearch}%")
            )
            ->orderBy('first_name')
            ->limit(8)
            ->get();
    }

    public function save(): void
    {
        $this->validate();

        Transaction::create([
            'customer_id'   => $this->customer_id,
            'recorded_by'   => auth()->id(),
            'amount'        => $this->amount,
            'points_earned' => $this->calculator->calculate((float) $this->amount),
            'transacted_at' => now(),
        ]);

        session()->flash('success', 'Transaction recorded successfully.');
        $this->redirect(route('transactions.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.transactions.create-transaction');
    }
}
