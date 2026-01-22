<x-layouts.app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-6">
   
                <a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800 flex items-center transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="border rounded-lg p-4 bg-gray-50">
                            <h3 class="text-lg font-bold mb-4 flex items-center text-gray-800">
                                <span class="mr-2">💰</span> Loyalty & Points
                            </h3>
                            
                            <div class="mb-4">
                                <label for="points_ratio" class="block text-sm font-medium text-gray-700">
                                    Points Ratio (PHP per 1 Point)
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-100 text-gray-500 text-sm">
                                        ₱
                                    </span>
                                    <input type="number" name="points_ratio" id="points_ratio" 
                                        value="{{ $settings->where('key', 'points_ratio')->first()?->value ?? 10 }}" 
                                        class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                        placeholder="10">
                                </div>
                                <p class="mt-2 text-xs text-gray-500">
                                    Current Rule: Customers earn 1 point for every ₱{{ $settings->where('key', 'points_ratio')->first()?->value ?? 10 }} spent.
                                </p>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4 bg-gray-50 opacity-60">
                            <h3 class="text-lg font-bold mb-4 flex items-center text-gray-800">
                                <span class="mr-2">⚙️</span> General Config
                            </h3>
                            <p class="text-sm text-gray-600 italic">No other settings configured yet.</p>
                        </div>

                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Save All Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app-layout>