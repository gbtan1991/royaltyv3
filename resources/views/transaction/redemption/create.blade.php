<x-layouts.app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm border mb-6">
                <h2 class="text-lg font-bold mb-4">Redemption: Find Customer</h2>
                <form action="{{ route('redemption.create') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Enter Name or ID..." 
                           value="{{ request('search') }}"
                           class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                        Search
                    </button>
                </form>
            </div>

            @if($customer)
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-1">
                        <div class="bg-gray-800 text-white p-6 rounded-xl shadow-lg">
                            <p class="text-xs uppercase tracking-widest opacity-60">Customer</p>
                            <h3 class="text-xl font-bold truncate">{{ $customer->user->full_name }}</h3>
                            
                            <div class="mt-6 pt-6 border-t border-gray-700">
                                <p class="text-xs uppercase tracking-widest opacity-60">Available Balance</p>
                                <p class="text-3xl font-black text-yellow-400">
                                    {{ number_format($customer->current_balance, 2) }} 
                                    <span class="text-sm">pts</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($rewards as $reward)
                        <div class="bg-white border rounded-lg p-5 flex flex-col justify-between shadow-sm">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-gray-900">{{ $reward->name }}</h4>
                                    <span class="text-xs font-semibold px-2 py-1 bg-gray-100 rounded">Stock: {{ $reward->stock_quantity }}</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ $reward->description }}</p>
                            </div>

                            <div class="mt-6 pt-4 border-t flex items-center justify-between">
                                <span class="text-lg font-bold text-indigo-600">{{ number_format($reward->points_cost) }} pts</span>
                                
                                @if($customer->current_balance >= $reward->points_cost && $reward->stock_quantity > 0)
                                    <form action="{{ route('redemption.store') }}" method="POST" onsubmit="return confirm('Claim this reward?')">
                                        @csrf
                                        <input type="hidden" name="customer_id" value="{{ $customer->user_id }}">
                                        <input type="hidden" name="reward_id" value="{{ $reward->id }}">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 px-4 rounded uppercase tracking-wider transition">
                                            Claim Reward
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="bg-gray-100 text-gray-400 text-xs font-bold py-2 px-4 rounded cursor-not-allowed uppercase italic">
                                        {{ $reward->stock_quantity <= 0 ? 'Out of Stock' : 'Not Enough Points' }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            @elseif(request('search'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded text-center">
                    No customer profile found for "{{ request('search') }}".
                </div>
            @endif

        </div>
    </div>
</x-layouts.app-layout>