<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\Redemption;
use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'stats'           => $this->stats(),
            'topCustomers'    => $this->topCustomers(),
            'latestCustomers' => $this->latestCustomers(),
            'recentActivity'  => $this->recentActivity(),
        ]);
    }

    private function stats(): array
    {
        return [
            'total_customers'    => Customer::count(),
            'active_customers'   => Customer::where('is_active', true)->count(),
            'total_transactions' => Transaction::count(),
            'total_points_issued' => (int) Transaction::sum('points_earned'),
            'total_points_spent'  => (int) Redemption::where('status', 'completed')->sum('points_spent'),
            'total_redemptions'  => Redemption::where('status', 'completed')->count(),
        ];
    }

    private function topCustomers(): \Illuminate\Database\Eloquent\Collection
    {
        return Customer::select('customers.*')
            ->selectSub(
                Transaction::selectRaw('COALESCE(SUM(points_earned), 0)')
                    ->whereColumn('customer_id', 'customers.id'),
                'total_earned'
            )
            ->selectSub(
                Redemption::selectRaw('COALESCE(SUM(points_spent), 0)')
                    ->whereColumn('customer_id', 'customers.id')
                    ->where('status', 'completed'),
                'total_spent'
            )
            ->orderByRaw('total_earned - total_spent DESC')
            ->limit(5)
            ->get();
    }

    private function latestCustomers(): \Illuminate\Database\Eloquent\Collection
    {
        return Customer::orderByDesc('created_at')->limit(5)->get();
    }

    private function recentActivity(): \Illuminate\Support\Collection
    {
        $transactions = Transaction::with('customer')
            ->orderByDesc('transacted_at')
            ->limit(8)
            ->get()
            ->map(fn ($tx) => (object) [
                'type'        => 'transaction',
                'description' => $tx->customer->full_name . ' earned ' . number_format($tx->points_earned) . ' pts',
                'detail'      => '₱' . number_format($tx->amount, 2) . ' purchase',
                'points'      => '+' . number_format($tx->points_earned),
                'points_color' => 'text-green-600',
                'date'        => $tx->transacted_at,
            ]);

        $redemptions = Redemption::with(['customer', 'reward'])
            ->where('status', 'completed')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get()
            ->map(fn ($r) => (object) [
                'type'        => 'redemption',
                'description' => $r->customer->full_name . ' redeemed ' . $r->reward->name,
                'detail'      => $r->reward->name,
                'points'      => '-' . number_format($r->points_spent),
                'points_color' => 'text-red-500',
                'date'        => $r->created_at,
            ]);

        return $transactions->concat($redemptions)
            ->sortByDesc('date')
            ->take(10)
            ->values();
    }
}
