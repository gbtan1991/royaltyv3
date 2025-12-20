<?php

namespace App\View\Components\customer;

use Closure;
use App\Models\CustomerProfile;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class customerList extends Component
{
    /**
     * Create a new component instance.
     */

    public $customers;

    public function __construct($customers)
    {
        $this->customers = $customers;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.customer.customer-list');
    }
}
