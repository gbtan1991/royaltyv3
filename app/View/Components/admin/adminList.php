<?php

namespace App\View\Components\admin;

use Closure;
use App\Models\Admin;
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
        $this->admins = Admin::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.admin-list');
    }
}
