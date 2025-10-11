<?php

namespace App\View\Components\partials\header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class toggleButton extends Component
{
    /**
     * Create a new component instance.
     */

    public $iconDefault;
    public $iconActive;
    public $size;
    public $borderRadius;
    public $target;

    public function __construct($iconDefault = 'fa-ellipsis-vertical', $iconActive = 'fa-ellipsis-vertical', $size = '10', $target= 'sidebarToggle', $borderRadius = 'rounded-lg')
    {
        $this->iconDefault = $iconDefault;
        $this->iconActive = $iconActive;
        $this->size = $size;
        $this->borderRadius = $borderRadius;
        $this->target = $target;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partials.header.toggle-button');
    }
}
