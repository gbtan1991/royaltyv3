<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Settings')]
class SettingsPage extends Component
{
    #[Validate('required|numeric|min:0.01|max:100')]
    public float $points_per_unit = 1.0;

    public function mount(): void
    {
        $this->points_per_unit = (float) Setting::get('points_per_unit', 1);
    }

    public function save(): void
    {
        $this->validate();

        Setting::set('points_per_unit', $this->points_per_unit);

        session()->flash('success', 'Settings saved.');
    }

    public function render()
    {
        return view('livewire.settings.settings-page');
    }
}
