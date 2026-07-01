<x-layouts.app>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
    </x-slot>

    {{-- Stats cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Customers</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_customers']) }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ number_format($stats['active_customers']) }} active</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Transactions</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_transactions']) }}</p>
            <p class="text-xs text-gray-400 mt-1">all time</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Redemptions</p>
            <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_redemptions']) }}</p>
            <p class="text-xs text-gray-400 mt-1">completed</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Points Issued</p>
            <p class="text-3xl font-bold text-indigo-600 mt-1">{{ number_format($stats['total_points_issued']) }}</p>
            <p class="text-xs text-gray-400 mt-1">pts earned total</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Points Redeemed</p>
            <p class="text-3xl font-bold text-red-500 mt-1">{{ number_format($stats['total_points_spent']) }}</p>
            <p class="text-xs text-gray-400 mt-1">pts spent total</p>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Points in Circulation</p>
            <p class="text-3xl font-bold text-emerald-600 mt-1">
                {{ number_format($stats['total_points_issued'] - $stats['total_points_spent']) }}
            </p>
            <p class="text-xs text-gray-400 mt-1">outstanding balance</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Top customers --}}
        <div class="lg:col-span-1 bg-white rounded-xl border border-gray-200 shadow-sm">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-700">Top Customers by Points</h2>
                <a href="{{ route('customers.index') }}" wire:navigate class="text-xs text-indigo-600 hover:underline">View all</a>
            </div>
            <ul class="divide-y divide-gray-100">
                @foreach ($topCustomers as $i => $customer)
                    @php $balance = $customer->total_earned - $customer->total_spent; @endphp
                    <li class="px-5 py-3 flex items-center gap-3">
                        <span class="flex-shrink-0 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                            {{ $i === 0 ? 'bg-yellow-100 text-yellow-700' : ($i === 1 ? 'bg-gray-100 text-gray-600' : ($i === 2 ? 'bg-orange-100 text-orange-600' : 'bg-gray-50 text-gray-400')) }}">
                            {{ $i + 1 }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $customer->full_name }}</p>
                            <p class="text-xs text-gray-400 font-mono">{{ $customer->member_number }}</p>
                        </div>
                        <div class="text-sm font-bold text-indigo-700 flex-shrink-0">
                            {{ number_format($balance) }}
                            <span class="text-xs font-normal text-gray-400">pts</span>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- Latest customers + activity feed --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Latest customers --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-gray-700">Latest Members</h2>
                    <a href="{{ route('customers.create') }}" wire:navigate class="text-xs text-indigo-600 hover:underline">+ Add customer</a>
                </div>
                <ul class="divide-y divide-gray-100">
                    @foreach ($latestCustomers as $customer)
                        <li class="px-5 py-3 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-sm font-semibold text-indigo-700 flex-shrink-0">
                                {{ strtoupper(substr($customer->first_name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">{{ $customer->full_name }}</p>
                                <p class="text-xs text-gray-400">{{ $customer->email ?? $customer->member_number }}</p>
                            </div>
                            <div class="text-right flex-shrink-0">
                                @php
                                    $tierColors = ['bronze' => 'bg-orange-100 text-orange-700', 'silver' => 'bg-gray-100 text-gray-600', 'gold' => 'bg-yellow-100 text-yellow-700'];
                                @endphp
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $tierColors[$customer->loyalty_tier] }}">
                                    {{ ucfirst($customer->loyalty_tier) }}
                                </span>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $customer->created_at->diffForHumans() }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Recent activity feed --}}
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-semibold text-gray-700">Recent Activity</h2>
                </div>
                <ul class="divide-y divide-gray-100">
                    @forelse ($recentActivity as $event)
                        <li class="px-5 py-3 flex items-center gap-3">
                            <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center
                                {{ $event->type === 'transaction' ? 'bg-green-100' : 'bg-red-50' }}">
                                @if ($event->type === 'transaction')
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                    </svg>
                                @else
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-gray-800">{{ $event->description }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $event->date->diffForHumans() }}</p>
                            </div>
                            <div class="flex-shrink-0 text-sm font-bold {{ $event->points_color }}">
                                {{ $event->points }}
                                <span class="text-xs font-normal text-gray-400">pts</span>
                            </div>
                        </li>
                    @empty
                        <li class="px-5 py-8 text-center text-sm text-gray-400">No recent activity.</li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>

</x-layouts.app>
