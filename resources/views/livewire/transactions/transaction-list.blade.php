<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Transactions</h1>
            <a href="{{ route('transactions.create') }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Record Transaction
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filters --}}
    <div class="mb-4 flex flex-col sm:flex-row gap-3">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search by customer name or member #…"
                class="pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none w-72"
            />
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
                    class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 underline">
                Clear filters
            </button>
        @endif
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3 text-right">Amount</th>
                    <th class="px-6 py-3 text-right">Points Earned</th>
                    <th class="px-6 py-3">Recorded By</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $transaction->customer->full_name }}</div>
                            <div class="text-xs text-gray-400 font-mono">{{ $transaction->customer->member_number }}</div>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-800">
                            ₱{{ number_format($transaction->amount, 2) }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center gap-1 text-green-700 font-semibold">
                                +{{ number_format($transaction->points_earned) }}
                                <span class="text-xs font-normal text-gray-400">pts</span>
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $transaction->recordedBy?->name ?? '—' }}
                        </td>
                        <td class="px-6 py-4 text-gray-500 text-xs">
                            {{ $transaction->transacted_at->format('M d, Y g:i A') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="confirmDelete({{ $transaction->id }})"
                                    class="text-red-500 hover:text-red-700 text-xs font-medium">
                                Delete
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            @if ($search || $customerFilter)
                                No transactions match the current filters.
                            @else
                                No transactions recorded yet.
                                <a href="{{ route('transactions.create') }}" wire:navigate class="text-indigo-600 hover:underline">Record one.</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($transactions->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

    {{-- Delete confirmation modal --}}
    @if ($confirmingDeleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">
                <div class="flex items-center gap-4 mb-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Delete Transaction</h3>
                        <p class="text-sm text-gray-500">The customer's points balance will update automatically.</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this transaction? This cannot be undone.</p>
                <div class="flex gap-3 justify-end">
                    <button wire:click="cancelDelete"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <button wire:click="delete"
                            class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
