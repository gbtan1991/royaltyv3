<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Rewards</h1>
            <a href="{{ route('rewards.create') }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Reward
            </a>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <div class="relative max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search rewards…"
                   class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"/>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-3">Reward</th>
                    <th class="px-6 py-3 text-right">Points Cost</th>
                    <th class="px-6 py-3 text-center">Stock</th>
                    <th class="px-6 py-3 text-center">Redeemed</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($rewards as $reward)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $reward->name }}</div>
                            @if ($reward->description)
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $reward->description }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-semibold text-indigo-700">{{ number_format($reward->points_cost) }}</span>
                            <span class="text-xs text-gray-400 ml-1">pts</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="{{ $reward->stock_quantity === 0 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                {{ $reward->stock_quantity }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600">{{ $reward->redemptions_count }}</td>
                        <td class="px-6 py-4 text-center">
                            @if ($reward->is_active && $reward->stock_quantity > 0)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">Available</span>
                            @elseif ($reward->is_active && $reward->stock_quantity === 0)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-700">Out of Stock</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('rewards.edit', $reward) }}" wire:navigate
                                   class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">Edit</a>
                                <button wire:click="confirmDelete({{ $reward->id }})"
                                        class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            @if ($search)
                                No rewards match "<strong>{{ $search }}</strong>".
                            @else
                                No rewards yet. <a href="{{ route('rewards.create') }}" wire:navigate class="text-indigo-600 hover:underline">Create one.</a>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if ($rewards->hasPages())
            <div class="px-6 py-3 border-t border-gray-200">{{ $rewards->links() }}</div>
        @endif
    </div>

    {{-- Delete modal --}}
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
                        <h3 class="text-base font-semibold text-gray-900">Delete Reward</h3>
                        <p class="text-sm text-gray-500">This cannot be undone.</p>
                    </div>
                </div>
                @if ($deleteError)
                    <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ $deleteError }}</div>
                @else
                    <p class="text-sm text-gray-600 mb-6">Are you sure you want to delete this reward?</p>
                @endif
                <div class="flex gap-3 justify-end">
                    <button wire:click="cancelDelete" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                        {{ $deleteError ? 'Close' : 'Cancel' }}
                    </button>
                    @if (!$deleteError)
                        <button wire:click="delete" class="px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Yes, Delete
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</x-layouts.app>
