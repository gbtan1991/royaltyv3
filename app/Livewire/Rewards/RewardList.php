<?php

namespace App\Livewire\Rewards;

use App\Models\Reward;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Rewards')]
class RewardList extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public ?int $confirmingDeleteId = null;
    public ?string $deleteError = null;

    public function updatingSearch(): void { $this->resetPage(); }

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
        $reward = Reward::findOrFail($this->confirmingDeleteId);

        if ($reward->redemptions()->where('status', 'completed')->exists()) {
            $this->deleteError = 'This reward has been redeemed and cannot be deleted. Deactivate it instead.';
            return;
        }

        $reward->delete();
        $this->confirmingDeleteId = null;
        session()->flash('success', 'Reward deleted.');
    }

    public function render()
    {
        $rewards = Reward::query()
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%")
            )
            ->withCount('redemptions')
            ->orderBy('points_cost')
            ->paginate(15);

        return view('livewire.rewards.reward-list', compact('rewards'));
    }
}
