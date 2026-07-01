<?php

namespace App\Livewire\Rewards;

use App\Livewire\Rewards\Forms\RewardFormData;
use App\Models\Reward;
use Livewire\Component;

class ManageReward extends Component
{
    public RewardFormData $form;
    public ?Reward $reward = null;

    public function mount(?Reward $reward = null): void
    {
        $this->reward = $reward;
        if ($reward) {
            $this->form->fill($reward);
        }
    }

    public function save(): void
    {
        if ($this->reward) {
            $this->form->update();
            session()->flash('success', 'Reward updated.');
        } else {
            $this->form->store();
            session()->flash('success', 'Reward created.');
        }

        $this->redirect(route('rewards.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.rewards.manage-reward')
            ->title($this->reward ? 'Edit Reward' : 'New Reward');
    }
}
