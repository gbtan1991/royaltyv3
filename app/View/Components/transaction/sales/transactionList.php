<?php

namespace App\View\Components\transaction\sales;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class transactionList extends Component
{

    // 1. Decalre the public property

    public $transactions;
    /**
     * Create a new component instance.
     */
    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transaction.sales.transaction-list');
    }
}
