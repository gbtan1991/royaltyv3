<x-layouts.app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="mb-6">
            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-500 hover:text-blue-600 flex items-center gap-1 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Loyalty Points Ledger</h1>
            <div class="text-sm text-gray-500">Total Movements: {{ $ledgerEntries->total() }}</div>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Customer</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Description & Reference</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ledgerEntries as $entry)
                        <tr class="hover:bg-gray-50">
                            {{-- Date Column --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $entry->ledger_date?->format('M d, Y') ?? 'No Date' }}
                                <div class="text-xs text-gray-400">
                                    {{ $entry->ledger_date?->format('h:i A') ?? '' }}
                                </div>
                            </td>

                            {{-- Customer Column --}}
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $entry->customer->user?->first_name }} {{ $entry->customer->user?->last_name }}
                                </div>
                                <div class="text-xs text-gray-500 font-mono italic">
                                    {{ $entry->customer?->member_id ?? 'No ID' }}
                                </div>
                            </td>

                            {{-- Description & Dynamic Linking Column --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="flex items-center gap-2 mb-1">
                                    {{ $entry->description }}
                                    {{-- Optional: Small Badge for Type --}}
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $entry->source_type === 'TRANSACTION' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                        {{ $entry->source_type }}
                                    </span>
                                </div>

                                @if ($entry->source_id)
                                    @if($entry->source_type === 'TRANSACTION')
                                        <a href="{{ route('transaction.show', $entry->source_id) }}"
                                           class="inline-flex items-center gap-1 text-xs text-blue-600 font-medium hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                            </svg>
                                            View Transaction #{{ $entry->source_id }}
                                        </a>
                                    @elseif($entry->source_type === 'CLAIM')
                                        <a href="{{ route('redemption.show', $entry->source_id) }}"
                                           class="inline-flex items-center gap-1 text-xs text-purple-600 font-medium hover:underline">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                            </svg>
                                            View Redemption #{{ $entry->source_id }}
                                        </a>
                                    @endif
                                @endif
                            </td>

                            {{-- Amount Column --}}
                            <td class="px-6 py-4 text-right">
                                <span class="text-sm font-bold {{ $entry->points_amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $entry->points_amount > 0 ? '+' : '' }}{{ number_format($entry->points_amount) }} pts
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">No ledger activity found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $ledgerEntries->links() }}
        </div>
    </div>
</x-layouts.app-layout>