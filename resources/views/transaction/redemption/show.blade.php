<x-layouts.app-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        {{-- Navigation --}}
        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('redemption.index') }}" class="flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Redemptions
            </a>
            <button onclick="window.print()" class="text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 py-1.5 px-3 rounded-md transition-colors flex items-center gap-2 no-print">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Voucher
            </button>
        </div>

        {{-- Voucher Card --}}
        <div class="bg-white shadow-xl rounded-xl border border-gray-200 overflow-hidden">
            {{-- Header --}}
            <div class="bg-purple-600 px-6 py-8 text-white text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 rounded-full mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold">Redemption Voucher</h1>
                <p class="text-purple-100 opacity-90">Transaction ID: #{{ str_pad($redemption->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Customer Details --}}
                    <div>
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Customer Information</h3>
                        <p class="text-lg font-semibold text-gray-900">{{ $redemption->user->first_name }} {{ $redemption->user->last_name }}</p>
                        <p class="text-sm text-gray-600 font-mono">{{ $redemption->user->customerProfile->member_id ?? 'No Member ID' }}</p>
                        <p class="text-sm text-gray-500 mt-1 italic">{{ $redemption->user->email }}</p>
                    </div>

                    {{-- Status and Date --}}
                    <div class="md:text-right">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Status</h3>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            {{ strtoupper($redemption->status) }}
                        </span>
                        <p class="text-sm text-gray-500 mt-4">Claimed on:</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $redemption->created_at->format('F d, Y') }}</p>
                        <p class="text-xs text-gray-400">{{ $redemption->created_at->format('h:i A') }}</p>
                    </div>
                </div>

                <hr class="my-8 border-gray-100">

                {{-- Reward Details --}}
                <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Item Redeemed</h3>
                    <p class="text-2xl font-black text-gray-900 text-center">{{ $redemption->reward->name }}</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="text-3xl font-bold text-purple-600">-{{ number_format($redemption->points_spent) }}</span>
                        <span class="text-gray-400 font-medium uppercase tracking-tighter">Points</span>
                    </div>
                </div>

                {{-- Verification Footer --}}
                <div class="mt-10 pt-6 border-t border-dashed border-gray-200 text-center">
                    <p class="text-xs text-gray-400">This is a system-generated voucher. Please present this to the administrator for verification.</p>
                    <div class="mt-4 opacity-30 grayscale flex justify-center">
                        {{-- Placeholder for a Barcode/QR if you add one later --}}
                        <div class="h-10 w-48 bg-gray-300 rounded flex items-center justify-center text-[10px] font-mono">
                            {{ $redemption->id }}-{{ $redemption->created_at->timestamp }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Links --}}
        <div class="mt-6 text-center no-print">
            <p class="text-sm text-gray-500">
                Need help? <a href="#" class="text-blue-600 hover:underline">Contact Administrator</a>
            </p>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
            .shadow-xl { shadow: none !important; border: 1px solid #eee; }
        }
    </style>
</x-layouts.app-layout>