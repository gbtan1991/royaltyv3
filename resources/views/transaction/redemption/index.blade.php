<x-layouts.app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Redemption History</h2>
                <a href="{{ route('dashboard') }}">Back to Dashboard</a>
                <a href="{{ route('redemption.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                    + New Redemption
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reward / Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points Deducted</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($redemptions as $redemption)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-gray-900">
                                    {{-- Using the full_name accessor from the User model --}}
                                    {{ $redemption->customer->user->full_name ?? 'Unknown' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    ID: {{ $redemption->customer->member_id ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $redemption->description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- Showing points as negative red text since they are deducted --}}
                                <span class="text-red-600 font-mono font-bold">
                                    {{ number_format($redemption->points_amount, 2) }} Pts
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $redemption->ledger_date->format('M d, Y') }}
                                <span class="text-xs block text-gray-400">{{ $redemption->ledger_date->format('h:i A') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                No redemptions found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
                {{-- Pagination Links --}}
                @if($redemptions->hasPages())
                    <div class="p-4 border-t bg-gray-50">
                        {{ $redemptions->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app-layout>