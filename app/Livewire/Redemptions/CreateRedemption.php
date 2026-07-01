<?php

namespace App\Livewire\Redemptions;

use App\Models\Customer;
use App\Models\Redemption;
use App\Models\Reward;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('New Redemption')]
class CreateRedemption extends Component
{
    // Customer typeahead
    public string $customerSearch = '';
    public ?int $customer_id = null;
    public string $selectedCustomerName = '';
    public bool $showCustomerDropdown = false;
    public ?int $customerBalance = null;

    #[Validate('required|exists:rewards,id')]
    public ?int $reward_id = null;

    public function updatedCustomerSearch(): void
    {
        $this->showCustomerDropdown = strlen($this->customerSearch) > 0;
        if ($this->selectedCustomerName !== $this->customerSearch) {
            $this->customer_id = null;
            $this->selectedCustomerName = '';
            $this->customerBalance = null;
            $this->reward_id = null;
        }
    }

    public function selectCustomer(int $id, string $name): void
    {
        $this->customer_id = $id;
        $this->customerSearch = $name;
        $this->selectedCustomerName = $name;
        $this->showCustomerDropdown = false;
        $this->reward_id = null;

        $customer = Customer::find($id);
        $this->customerBalance = $customer?->pointsBalance() ?? 0;
    }

    public function clearCustomer(): void
    {
        $this->customer_id = null;
        $this->customerSearch = '';
        $this->selectedCustomerName = '';
        $this->showCustomerDropdown = false;
        $this->customerBalance = null;
        $this->reward_id = null;
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

    #[Computed]
    public function availableRewards(): \Illuminate\Database\Eloquent\Collection
    {
        return Reward::where('is_active', true)
            ->where('stock_quantity', '>', 0)
            ->orderBy('points_cost')
            ->get();
    }

    #[Computed]
    public function selectedReward(): ?Reward
    {
        return $this->reward_id ? Reward::find($this->reward_id) : null;
    }

    public function save(): void
    {
        if (! $this->customer_id) {
            $this->addError('customer_id', 'Please select a customer.');
            return;
        }

        $this->validate();

        DB::transaction(function () {
            $reward   = Reward::findOrFail($this->reward_id);
            $customer = Customer::findOrFail($this->customer_id);

            // Re-validate inside the transaction (guard against concurrent changes)
            if ($reward->stock_quantity <= 0) {
                $this->addError('reward_id', 'This reward is now out of stock.');
                return;
            }

            $balance = $customer->pointsBalance();
            if ($balance < $reward->points_cost) {
                $this->addError('customer_id', "Customer only has {$balance} pts — not enough for this reward.");
                return;
            }

            $reward->decrement('stock_quantity');

            Redemption::create([
                'customer_id'  => $customer->id,
                'reward_id'    => $reward->id,
                'redeemed_by'  => auth()->id(),
                'points_spent' => $reward->points_cost,
                'status'       => 'completed',
            ]);
        });

        if (! $this->getErrorBag()->isNotEmpty()) {
            session()->flash('success', 'Redemption recorded. Customer balance updated automatically.');
            $this->redirect(route('redemptions.index'), navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.redemptions.create-redemption');
    }
}
