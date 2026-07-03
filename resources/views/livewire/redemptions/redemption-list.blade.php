    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Redemptions</h1>
            <a href="{{ route('redemptions.create') }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Redemption
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4 flex flex-col sm:flex-row gap-3">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text"
                   placeholder="Search by customer or reward…"
                   class="pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none w-72"/>
        </div>
        <select wire:model.live="customerFilter"
                class="px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white">
            <option value="">All Customers</option>
            @foreach ($customers as $c)
                <option value="{{ $c->id }}">{{ $c->full_name }}</option>
            @endforeach
        </select>
        @if ($customerFilter || $search)
            <button wire:click="$set('customerFilter', ''); $set('search', '')"
                    class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 underline">Clear</button>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Reward</th>
                    <th class="px-6 py-3 text-right">Points Spent</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3">Processed By</th>
                    <th class="px-6 py-3">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($redemptions as $redemption)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $redemption->customer->full_name }}</div>
                            <div class="text-xs text-gray-400 font-mono">{{ $redemption->customer->member_number }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-700">{{ $redemption->reward->name }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-semibold text-red-600">-{{ number_format($redemption->points_spent) }}</span>
                            <span class="text-xs text-gray-400 ml-1">pts</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $redemption->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ ucfirst($redemption->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">{{ $redemption->redeemedBy?->name ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $redemption->created_at->format('M d, Y g:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            @if ($search || $customerFilter)
                                No redemptions match the current filters.
                            @else
                                No redemptions recorded yet.
                                <a href="{{ route('redemptions.create') }}" wire:navigate class="text-indigo-600 hover:underline">Record one.</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($redemptions->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">{{ $redemptions->links() }}</div>
        @endif
    </div>
