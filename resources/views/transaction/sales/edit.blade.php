<x-layouts.app-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('transaction.show', $transaction) }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Cancel and Go Back
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900">Edit Transaction #{{ $transaction->id }}</h2>
                <p class="text-sm text-gray-500 font-medium">Customer: {{ $transaction->customer->first_name }} {{ $transaction->customer->last_name }}</p>
            </div>

            <form action="{{ route('transaction.update', $transaction) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    {{-- Transaction Date --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transaction Date & Time</label>
                        <input type="datetime-local" name="transaction_date" 
                               value="{{ $transaction->transaction_date->format('Y-m-d\TH:i') }}"
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Amount --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Total Amount (₱)</label>
                        <div class="relative">
                            <span class="absolute left-3 top-2 text-gray-400">₱</span>
                            <input type="number" step="0.01" name="amount" value="{{ $transaction->amount }}"
                                   class="w-full pl-8 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-bold">
                        </div>
                        <p class="mt-2 text-xs text-amber-600 italic">
                            * Updating the amount will automatically recalculate loyalty points.
                        </p>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app-layout>