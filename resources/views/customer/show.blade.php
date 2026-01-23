<x-layouts.app-layout>
    <div class="py-8 px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Customer Profile</h1>
            <a href="{{ route('customer.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                &larr; Back to List
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Column: Profile Card --}}
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 shadow-md rounded-xl border border-gray-100 flex flex-col items-center">
                    <img src="{{ app(\Laravolt\Avatar\Avatar::class)->create($customer->user->full_name)->toBase64() }}"
                        class="w-32 h-32 rounded-full shadow-inner mb-4 border-4 border-gray-50" />
                    
                    <h2 class="text-xl font-bold text-gray-900">{{ $customer->user->full_name }}</h2>
                    <p class="text-gray-500 text-sm mb-4">{{ $customer->user->access_key }}</p>
                    
                    <span class="px-4 py-1 {{ $customer->loyalty_tier == 'Gold' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }} text-xs font-black rounded-full uppercase tracking-widest">
                        {{ $customer->loyalty_tier }} Member
                    </span>

                    <div class="w-full mt-6 pt-6 border-t border-gray-100 space-y-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Member ID</span>
                            <span class="font-mono font-bold text-blue-600">{{ $customer->member_id }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Gender</span>
                            <span>{{ ucfirst($customer->user->gender) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Birthdate</span>
                            <span>{{ $customer->user->birth_date ? $customer->user->birth_date->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Joined</span>
                            <span>{{ $customer->created_at->format('M Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-8 flex w-full gap-2">
                        <a href="{{ route('customer.edit', $customer->user_id) }}" class="flex-1 text-center py-2 bg-gray-800 text-white text-sm rounded-lg hover:bg-gray-700 transition">
                            Edit
                        </a>
                        <form action="{{ route('customer.destroy', $customer->user_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Delete customer?')">
                            @csrf @method('DELETE')
                            <button class="w-full py-2 bg-red-50 text-red-600 text-sm rounded-lg hover:bg-red-600 hover:text-white transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Right Column: Balance & Reward Progress --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Points Summary Card --}}
                <div class="bg-gradient-to-br from-indigo-600 to-blue-700 p-8 rounded-xl shadow-lg text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <p class="text-indigo-100 text-sm uppercase tracking-widest font-semibold">Available Balance</p>
                        <h3 class="text-5xl font-black mt-2 text-yellow-400">
                            {{ number_format($currentBalance, 2) }} <span class="text-xl text-white">pts</span>
                        </h3>
                    </div>
                    {{-- Decorative Icon --}}
                    <svg class="absolute right-[-20px] bottom-[-20px] w-48 h-48 text-white opacity-10" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>

                {{-- Reward Progress Module --}}
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Reward Milestones</h3>
                    <div class="space-y-6">
                        @foreach($rewards as $reward)
                            @php
                                $percent = ($currentBalance / $reward->points_cost) * 100;
                                $progress = min($percent, 100);
                                $remaining = max($reward->points_cost - $currentBalance, 0);
                            @endphp
                            <div>
                                <div class="flex justify-between items-end mb-2">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $reward->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $reward->description }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm font-bold {{ $remaining <= 0 ? 'text-green-600' : 'text-gray-400' }}">
                                            {{ $remaining <= 0 ? 'Unlocked!' : number_format($remaining) . ' pts left' }}
                                        </span>
                                        <p class="text-[10px] uppercase text-gray-400">Goal: {{ number_format($reward->points_cost) }}</p>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-3">
                                    <div class="h-3 rounded-full transition-all duration-1000 {{ $remaining <= 0 ? 'bg-green-500' : 'bg-indigo-600' }}" 
                                         style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app-layout>