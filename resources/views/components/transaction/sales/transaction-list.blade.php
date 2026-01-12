   <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50 border-b border-gray-200">
            <tr>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Date/Time</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Customer</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Loyalty Points</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Processed By</th>
                <th class="px-6 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($transactions as $trx)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- 1. Date & Time --}}
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $trx->transaction_date->format('M d, Y') }}
                        <div class="text-xs text-gray-400">{{ $trx->transaction_date->format('h:i A') }}</div>
                    </td>

                    {{-- 2. Customer Identity --}}
                    <td class="px-6 py-4">
                        <div class="text-sm font-semibold text-gray-900">
                            {{ $trx->customer->first_name }} {{ $trx->customer->last_name }}
                        </div>
                        <div class="text-xs text-gray-500 font-mono italic">
                            {{ $trx->customer->customerProfile->member_id ?? 'No ID' }}
                        </div>
                    </td>

                    {{-- 3. Financial Amount --}}
                    <td class="px-6 py-4">
                        <span class="text-sm font-bold text-gray-900">
                            ₱{{ number_format($trx->amount, 2) }}
                        </span>
                    </td>

                    {{-- 4. Points Earned --}}
                    <td class="px-6 py-4">
                        @if($trx->points_ledger_id && $trx->pointsLedger)
                            <div class="flex items-center gap-1 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                <span class="text-sm font-bold">+{{ $trx->pointsLedger->points_amount }} pts</span>
                            </div>
                        @else
                            <span class="text-xs text-gray-400 italic">No points earned</span>
                        @endif
                    </td>

                    {{-- 5. Admin Identity --}}
                    <td class="px-6 py-4 text-right">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $trx->admin->first_name ?? 'System' }}
                        </span>
                    </td>

                    {{-- 6. Actions Column (FIXED POSITION) --}}
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="flex justify-center items-center gap-3">
                            <a href="{{ route('transaction.show', $trx->id) }}" class="text-blue-600 hover:text-blue-900" title="View Details">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>

                            <a href="{{ route('transaction.edit', $trx->id) }}" class="text-amber-600 hover:text-amber-900" title="Edit Transaction">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>

                            <form action="{{ route('transaction.destroy', $trx->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this transaction and its points?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        No transactions found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    {{-- Pagination Links (Important for performance as history grows) --}}
    @if(method_exists($transactions, 'links'))
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    @endif