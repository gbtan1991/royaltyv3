<div>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('transactions.index') }}" wire:navigate class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">Record Transaction</h1>
        </div>
    </x-slot>

    <div class="max-w-lg">
        <form wire:submit="save" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">

            {{-- Customer typeahead --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Customer <span class="text-red-500">*</span>
                </label>

                <div class="relative" x-data="{ open: @entangle('showDropdown') }">
                    <div class="flex items-center gap-2">
                        <div class="relative flex-1">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input
                                wire:model.live.debounce.200ms="customerSearch"
                                type="text"
                                placeholder="Type to search customers…"
                                autocomplete="off"
                                class="w-full pl-9 pr-4 py-2 text-sm border rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                    {{ $errors->has('customer_id') ? 'border-red-400' : 'border-gray-300' }}
                                    {{ $customer_id ? 'bg-indigo-50 border-indigo-300 font-medium text-indigo-900' : '' }}"
                                @focus="open = $wire.customerSearch.length > 0"
                            />
                        </div>
                        @if ($customer_id)
                            <button type="button" wire:click="clearCustomer"
                                    class="text-gray-400 hover:text-gray-600 transition p-1" title="Clear">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        @endif
                    </div>

                    {{-- Dropdown results --}}
                    <div x-show="open" x-transition
                         class="absolute z-20 mt-1 w-full bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                        @forelse ($this->customerResults as $c)
                            <button type="button"
                                    wire:click="selectCustomer({{ $c->id }}, '{{ addslashes($c->full_name) }}')"
                                    class="w-full text-left px-4 py-2.5 text-sm hover:bg-indigo-50 transition flex items-center justify-between">
                                <span>
                                    <span class="font-medium text-gray-900">{{ $c->full_name }}</span>
                                    <span class="text-gray-400 text-xs ml-2 font-mono">{{ $c->member_number }}</span>
                                </span>
                            </button>
                        @empty
                            @if (strlen($customerSearch) > 0)
                                <div class="px-4 py-3 text-sm text-gray-400">No customers found.</div>
                            @endif
                        @endforelse
                    </div>
                </div>

                @error('customer_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Amount input --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Payment Amount <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">₱</span>
                    <input
                        wire:model.live="amount"
                        type="number"
                        step="0.01"
                        min="0.01"
                        placeholder="0.00"
                        class="w-full pl-7 pr-4 py-2 text-sm border rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                            {{ $errors->has('amount') ? 'border-red-400' : 'border-gray-300' }}"
                    />
                </div>
                @error('amount')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Live points preview --}}
            <div class="rounded-lg border-2 border-dashed p-4 flex items-center justify-between transition
                {{ $pointsPreview > 0 ? 'border-indigo-200 bg-indigo-50' : 'border-gray-200 bg-gray-50' }}">
                <div class="text-sm text-gray-500">Points to be earned</div>
                <div class="text-2xl font-bold {{ $pointsPreview > 0 ? 'text-indigo-700' : 'text-gray-300' }}">
                    {{ $pointsPreview > 0 ? number_format($pointsPreview) : '—' }}
                    @if ($pointsPreview > 0)
                        <span class="text-base font-normal text-indigo-400">pts</span>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-60 cursor-not-allowed"
                        class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <span wire:loading.remove wire:target="save">Record Transaction</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
                <a href="{{ route('transactions.index') }}" wire:navigate
                   class="px-5 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Cancel</a>
            </div>

        </form>
    </div>
</div>
