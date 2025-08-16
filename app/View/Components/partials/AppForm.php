<?php

namespace App\View\Components\partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $action;
    public $title;
    public $desctiption;
    public $method;
    




    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partials.app-form');
    }
}
