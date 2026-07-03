<div>
    <x-slot name="header">
        <h1 class="text-xl font-semibold text-gray-800">Settings</h1>
    </x-slot>

    <div class="max-w-xl">

        @if (session('success'))
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-sm font-semibold text-gray-700 mb-1">Points Formula</h2>
            <p class="text-xs text-gray-400 mb-5">Controls how many points a customer earns per currency unit spent. Applies to all new transactions immediately.</p>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Points per unit spent
                    </label>
                    <div class="flex items-center gap-3">
                        <input wire:model="points_per_unit" type="number" step="0.01" min="0.01" max="100"
                               class="w-40 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"/>
                        <span class="text-sm text-gray-500">pts per ₱1.00</span>
                    </div>
                    @error('points_per_unit')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-1">
                    <button wire:click="save" wire:loading.attr="disabled" wire:loading.class="opacity-60 cursor-not-allowed"
                            class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                        <span wire:loading.remove wire:target="save">Save Settings</span>
                        <span wire:loading wire:target="save">Saving…</span>
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>
