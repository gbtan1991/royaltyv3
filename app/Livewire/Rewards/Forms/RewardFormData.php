<?php

namespace App\Livewire\Rewards\Forms;

use App\Models\Reward;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RewardFormData extends Form
{
    public ?Reward $reward = null;

    #[Validate('required|string|max:150')]
    public string $name = '';

    #[Validate('nullable|string|max:500')]
    public string $description = '';

    #[Validate('required|integer|min:1')]
    public string $pointsCost = '';

    #[Validate('required|integer|min:0')]
    public string $stockQuantity = '0';

    #[Validate('boolean')]
    public bool $isActive = true;

    public function fill(Reward $reward): void
    {
        $this->reward        = $reward;
        $this->name          = $reward->name;
        $this->description   = $reward->description ?? '';
        $this->pointsCost    = (string) $reward->points_cost;
        $this->stockQuantity = (string) $reward->stock_quantity;
        $this->isActive      = $reward->is_active;
    }

    public function store(): Reward
    {
        $this->validate();

        return Reward::create([
            'name'           => $this->name,
            'description'    => $this->description ?: null,
            'points_cost'    => (int) $this->pointsCost,
            'stock_quantity' => (int) $this->stockQuantity,
            'is_active'      => $this->isActive,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $this->reward->update([
            'name'           => $this->name,
            'description'    => $this->description ?: null,
            'points_cost'    => (int) $this->pointsCost,
            'stock_quantity' => (int) $this->stockQuantity,
            'is_active'      => $this->isActive,
        ]);
    }
}
