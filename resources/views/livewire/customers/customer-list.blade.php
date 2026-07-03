<div>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Customers</h1>
            <a href="{{ route('customers.create') }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Customer
            </a>
        </div>
    </x-slot>

    {{-- Flash message --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Search --}}
    <div class="mb-4">
        <div class="relative max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input
                wire:model.live.debounce.300ms="search"
                type="text"
                placeholder="Search by name, email, or member #…"
                class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
            />
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Member #</th>
                    <th class="px-6 py-3">Tier</th>
                    <th class="px-6 py-3 text-right">Points Balance</th>
                    <th class="px-6 py-3 text-center">Transactions</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($customers as $customer)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $customer->full_name }}</div>
                            @if ($customer->email)
                                <div class="text-gray-500 text-xs mt-0.5">{{ $customer->email }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-mono text-xs text-gray-600">{{ $customer->member_number }}</td>
                        <td class="px-6 py-4">
                            @php
                                $tierColors = ['bronze' => 'bg-orange-100 text-orange-700', 'silver' => 'bg-gray-100 text-gray-700', 'gold' => 'bg-yellow-100 text-yellow-700'];
                            @endphp
                            <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $tierColors[$customer->loyalty_tier] ?? '' }}">
                                {{ ucfirst($customer->loyalty_tier) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold text-gray-800">
                            {{ number_format($customer->pointsBalance()) }}
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600">{{ $customer->transactions_count }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($customer->is_active)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Active</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('customers.edit', $customer) }}" wire:navigate
                                   class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">Edit</a>
                                <button wire:click="confirmDelete({{ $customer->id }})"
                                        class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            @if ($search)
                                No customers match "<strong>{{ $search }}</strong>".
                            @else
                                No customers yet. <a href="{{ route('customers.create') }}" wire:navigate class="text-indigo-600 hover:underline">Add one.</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($customers->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">
                {{ $customers->links() }}
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
                        <h3 class="text-base font-semibold text-gray-900">Delete Customer</h3>
                        <p class="text-sm text-gray-500">This action cannot be undone.</p>
                    </div>
                </div>

                @if ($deleteError)
                    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        {{ $deleteError }}
                    </div>
                @else
                    <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this customer?</p>
                @endif

                <div class="flex gap-3 justify-end">
                    <button wire:click="cancelDelete"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        {{ $deleteError ? 'Close' : 'Cancel' }}
                    </button>
                    @if (!$deleteError)
                        <button wire:click="delete"
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Yes, Delete
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
