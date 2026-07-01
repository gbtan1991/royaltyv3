<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('redemptions.index') }}" wire:navigate class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">New Redemption</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl space-y-5">

        {{-- Step 1: Select Customer --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">1</span>
                Select Customer
            </h2>

            <div class="relative" x-data="{ open: @entangle('showCustomerDropdown') }">
                <div class="flex items-center gap-2">
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input wire:model.live.debounce.200ms="customerSearch" type="text"
                               placeholder="Type to search customers…" autocomplete="off"
                               class="w-full pl-9 pr-4 py-2 text-sm border rounded-lg outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
                                   {{ $customer_id ? 'bg-indigo-50 border-indigo-300 font-medium text-indigo-900' : 'border-gray-300' }}"
                               @focus="open = $wire.customerSearch.length > 0"/>
                    </div>
                    @if ($customer_id)
                        <button type="button" wire:click="clearCustomer" class="text-gray-400 hover:text-gray-600 p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    @endif
                </div>

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

            @error('customer_id') <p class="mt-2 text-xs text-red-600">{{ $message }}</p> @enderror

            {{-- Customer balance badge --}}
            @if ($customer_id && $customerBalance !== null)
                <div class="mt-4 flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                    <div class="text-sm text-gray-500">Current points balance:</div>
                    <div class="text-lg font-bold {{ $customerBalance > 0 ? 'text-indigo-700' : 'text-red-600' }}">
                        {{ number_format($customerBalance) }} pts
                    </div>
                </div>
            @endif
        </div>

        {{-- Step 2: Select Reward (only shown after customer is chosen) --}}
        @if ($customer_id)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">2</span>
                    Select Reward
                    <span class="text-xs font-normal text-gray-400 ml-1">— rewards the customer can afford are highlighted</span>
                </h2>

                @error('reward_id') <p class="mb-3 text-xs text-red-600">{{ $message }}</p> @enderror

                @if ($this->availableRewards->isEmpty())
                    <p class="text-sm text-gray-400">No active rewards with stock available.</p>
                @else
                    <div class="space-y-2">
                        @foreach ($this->availableRewards as $reward)
                            @php $affordable = $customerBalance >= $reward->points_cost; @endphp
                            <label
                                class="flex items-center justify-between p-3 rounded-lg border-2 cursor-pointer transition
                                    {{ $reward_id === $reward->id
                                        ? 'border-indigo-500 bg-indigo-50'
                                        : ($affordable ? 'border-gray-200 hover:border-indigo-300' : 'border-gray-100 bg-gray-50 opacity-60 cursor-not-allowed') }}">
                                <div class="flex items-center gap-3">
                                    <input type="radio" wire:model="reward_id" value="{{ $reward->id }}"
                                           {{ !$affordable ? 'disabled' : '' }}
                                           class="text-indigo-600 focus:ring-indigo-500"/>
                                    <div>
                                        <div class="text-sm font-medium {{ $affordable ? 'text-gray-900' : 'text-gray-400' }}">
                                            {{ $reward->name }}
                                        </div>
                                        @if ($reward->description)
                                            <div class="text-xs text-gray-400 mt-0.5">{{ $reward->description }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="text-right ml-4 flex-shrink-0">
                                    <div class="text-sm font-bold {{ $affordable ? 'text-indigo-700' : 'text-gray-400' }}">
                                        {{ number_format($reward->points_cost) }} pts
                                    </div>
                                    <div class="text-xs text-gray-400">{{ $reward->stock_quantity }} left</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        {{-- Step 3: Confirm --}}
        @if ($customer_id && $reward_id && $this->selectedReward)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-indigo-100 text-indigo-700 text-xs font-bold">3</span>
                    Confirm Redemption
                </h2>
                <div class="bg-gray-50 rounded-lg p-4 space-y-2 text-sm mb-4">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Customer</span>
                        <span class="font-medium text-gray-900">{{ $selectedCustomerName }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Reward</span>
                        <span class="font-medium text-gray-900">{{ $this->selectedReward->name }}</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-gray-500">Points before</span>
                        <span class="font-semibold text-gray-800">{{ number_format($customerBalance) }} pts</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Points deducted</span>
                        <span class="font-semibold text-red-600">-{{ number_format($this->selectedReward->points_cost) }} pts</span>
                    </div>
                    <div class="flex justify-between border-t border-gray-200 pt-2">
                        <span class="text-gray-500">Points after</span>
                        <span class="font-bold text-indigo-700">{{ number_format($customerBalance - $this->selectedReward->points_cost) }} pts</span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button wire:click="save" wire:loading.attr="disabled" wire:loading.class="opacity-60 cursor-not-allowed"
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        <span wire:loading.remove wire:target="save">Confirm Redemption</span>
                        <span wire:loading wire:target="save">Processing…</span>
                    </button>
                    <a href="{{ route('redemptions.index') }}" wire:navigate
                       class="px-5 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Cancel</a>
                </div>
            </div>
        @endif

    </div>
</x-layouts.app>
