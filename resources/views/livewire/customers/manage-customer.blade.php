    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('customers.index') }}" wire:navigate class="text-gray-400 hover:text-gray-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h1 class="text-xl font-semibold text-gray-800">
                {{ $customer ? 'Edit Customer' : 'Add Customer' }}
            </h1>
        </div>
    </x-slot>

    <div class="max-w-2xl">
        <form wire:submit="save" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-5">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input wire:model="form.firstName" type="text"
                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none @error('form.firstName') border-red-400 @enderror"/>
                    @error('form.firstName')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input wire:model="form.lastName" type="text"
                           class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none @error('form.lastName') border-red-400 @enderror"/>
                    @error('form.lastName')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input wire:model="form.email" type="email"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none @error('form.email') border-red-400 @enderror"/>
                @error('form.email')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                <input wire:model="form.phone" type="text"
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"/>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Loyalty Tier <span class="text-red-500">*</span></label>
                <select wire:model="form.loyaltyTier"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white">
                    <option value="bronze">Bronze</option>
                    <option value="silver">Silver</option>
                    <option value="gold">Gold</option>
                </select>
                @error('form.loyaltyTier')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3">
                <button type="button"
                    wire:click="$set('form.isActive', !{{ $form->isActive ? 'true' : 'false' }})"
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition
                        {{ $form->isActive ? 'bg-indigo-600' : 'bg-gray-300' }}">
                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition
                        {{ $form->isActive ? 'translate-x-6' : 'translate-x-1' }}"></span>
                </button>
                <label class="text-sm font-medium text-gray-700">Active</label>
            </div>

            <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-60 cursor-not-allowed"
                        class="px-5 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    <span wire:loading.remove wire:target="save">{{ $customer ? 'Save Changes' : 'Add Customer' }}</span>
                    <span wire:loading wire:target="save">Saving…</span>
                </button>
                <a href="{{ route('customers.index') }}" wire:navigate
                   class="px-5 py-2 text-sm font-medium text-gray-600 hover:text-gray-800 transition">Cancel</a>
            </div>

        </form>
    </div>
