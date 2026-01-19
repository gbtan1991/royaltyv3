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
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($ledgerEntries as $entry)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $entry->ledger_date?->format('M d, Y') ?? 'No Date' }}
                                <div class="text-xs text-gray-400">
                                    {{ $entry->ledger_date?->format('h:i A') ?? '' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $entry->customer?->first_name }} {{ $entry->customer?->last_name }}
                                </div>
                                <div class="text-xs text-gray-500 font-mono italic">
                                    {{ $entry->customer?->customerProfile?->member_id ?? 'No ID' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $entry->description }}
                                @if ($entry->source_id)
                                    <a href="{{ route('transaction.show', $entry->source_id) }}"
                                        class="block text-xs text-blue-600 hover:underline">
                                        View Linked Transaction #{{ $entry->source_id }}
                                    </a>
                                @endif
                            </td>
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