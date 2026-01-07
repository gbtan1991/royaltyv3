<x-layouts.app-layout>
<div class="max-w-2xl mx-auto">
        <div class="flex items-center gap-2 mb-6">
            <a href="{{ route('transaction.index') }}" class="text-blue-600 hover:text-blue-800 transition">
                &larr; Back to List
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Record New Transaction</h1>
        </div>

        <div class="bg-white p-8 shadow-md rounded-lg border border-gray-100">
            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf

                {{-- Customer Selection --}}
                <div class="mb-6">
                    <label for="customer_user_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Customer <span class="text-red-500">*</span>
                    </label>
                    <select name="customer_user_id" id="customer_user_id" 
                            class="w-full border rounded-md px-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none @error('customer_user_id') border-red-500 @enderror">
                        <option value="">-- Search/Select Customer --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->user_id }}" {{ old('customer_user_id') == $customer->user_id ? 'selected' : '' }}>
                                {{ $customer->user->first_name }} {{ $customer->user->last_name }} — ({{ $customer->member_id }})
                            </option>
                        @endforeach
                    </select>
                    @error('customer_user_id') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                {{-- Amount Input --}}
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">
                        Amount Paid (PHP) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-2.5 text-gray-400 font-bold">₱</span>
                        <input type="number" name="amount" id="amount" step="0.01" min="1" 
                               value="{{ old('amount') }}"
                               placeholder="0.00"
                               class="w-full border rounded-md pl-10 pr-4 py-2.5 focus:ring-2 focus:ring-blue-500 outline-none @error('amount') border-red-500 @enderror">
                    </div>
                    @error('amount') 
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p> 
                    @enderror
                    
                    {{-- Real-time Hint --}}
                    <div class="mt-3 p-3 bg-blue-50 rounded-md border border-blue-100">
                        <p class="text-xs text-blue-700 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Reward Rule: <strong>₱5.00 = 1 Point</strong>. Points will be calculated automatically.
                        </p>
                    </div>
                </div>

                <hr class="my-8 border-gray-100">

                {{-- Action Buttons --}}
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-400 italic">
                        Logged as: {{ auth()->user()->username }}
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('transaction.index') }}" class="px-6 py-2.5 text-gray-600 hover:text-gray-800 transition font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="px-8 py-2.5 bg-blue-600 text-white rounded-md hover:bg-blue-700 shadow-md transition font-bold">
                            Complete Transaction
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</x-layouts.app-layout>