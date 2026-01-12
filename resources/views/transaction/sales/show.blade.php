<x-layouts.app-layout>
    <div class="max-w-3xl mx-auto px-4 py-8">
        {{-- Back Navigation --}}
        <div class="mb-6">
            <a href="{{ route('transaction.index') }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Transaction List
            </a>
        </div>

        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-100">
            {{-- Header/Status --}}
            <div class="bg-gray-50 px-8 py-6 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Transaction Details</h2>
                    <p class="text-sm text-gray-500 font-mono">ID: #{{ str_pad($transaction->id, 8, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="text-right">
                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">Completed</span>
                </div>
            </div>

            <div class="p-8 space-y-8">
                {{-- Two Column Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Customer Info --}}
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Customer Information</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ $transaction->customer->first_name ?? 'N/A' }} {{ $transaction->customer->last_name ?? 'N/A'}}</p>
                        <p class="text-sm text-gray-600">{{ $transaction->customer->email ?? 'N/A' }}</p>
                        <p class="text-sm font-mono text-blue-600 mt-1">Member ID: {{ $transaction->customer->customerProfile->member_id ?? 'N/A' }}</p>
                    </div>

                    {{-- Transaction Timing --}}
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Timestamp</h3>
                        <p class="text-gray-900">{{ $transaction->transaction_date?->format('F d, Y') ?? 'N/A' }}</p>
                        <p class="text-gray-600">{{ $transaction->transaction_date?->format('h:i:s A') ?? 'N/A'}}</p>
                    </div>
                </div>

                <hr class="border-gray-100">

                {{-- Financial Breakdown --}}
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-gray-600">Total Amount Paid</span>
                        <span class="text-2xl font-black text-gray-900">₱{{ number_format($transaction->amount, 2) }}</span>
                    </div>
                    
                    @if($transaction->pointsLedger)
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <span class="text-gray-600">Loyalty Points Earned</span>
                            <span class="text-lg font-bold text-green-600">+{{ $transaction->pointsLedger->points_amount }} Points</span>
                        </div>
                        <p class="text-xs text-gray-400 italic mt-2 text-right">Source: {{ $transaction->pointsLedger->description }}</p>
                    @endif
                </div>

                {{-- Footer Info --}}
                <div class="flex justify-between items-center text-xs text-gray-400 pt-4">
                    <p>Processed by Admin: <span class="font-medium text-gray-600">{{ $transaction->admin->first_name ?? 'System' }}</span></p>
                    <p>Recorded at: {{ $transaction->created_at?->format('Y-m-d H:i') ?? 'N/A' }}</p>
                </div>
            </div>
            
            {{-- Action Bar --}}
            <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-end gap-3">
                <button onclick="window.print()" class="text-sm font-medium text-gray-600 hover:text-gray-900 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Print Receipt
                </button>
            </div>
        </div>
    </div>
</x-layouts.app-layout>