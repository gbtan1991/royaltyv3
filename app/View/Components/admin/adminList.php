<?php

namespace App\View\Components\admin;

use Closure;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class adminList extends Component
{
    /**
     * Create a new component instance.
     * 
     */

    public $admins;

    public function __construct($admins)
    {
        $this->admins = $admins;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-list');
    }
}
