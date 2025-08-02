<?php

namespace App\View\Components\dashboard\partials\header\mobile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class mobileAppLogo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.partials.header.mobile.mobile-app-logo');
    }
}
