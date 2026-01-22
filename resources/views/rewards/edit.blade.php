<x-layouts.app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('rewards.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                    ← Back to Catalog
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border">
                <div class="flex justify-between items-center mb-6 border-b pb-4">
                    <h2 class="text-xl font-bold text-gray-800">Edit Reward: {{ $reward->name }}</h2>
                    <span class="text-xs text-gray-500">ID: #{{ $reward->id }}</span>
                </div>

                <form action="{{ route('rewards.update', $reward->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Reward Name</label>
                            <input type="text" name="name" value="{{ old('name', $reward->name) }}" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $reward->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Points Cost</label>
                                <input type="number" name="points_cost" value="{{ old('points_cost', $reward->points_cost) }}" required min="1" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Current Stock</label>
                                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $reward->stock_quantity) }}" required min="0" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $reward->is_active ? 'checked' : '' }} 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">Active and available for redemption</label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a href="{{ route('rewards.index') }}" class="bg-gray-100 text-gray-700 px-6 py-2 rounded font-bold hover:bg-gray-200 transition">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded shadow transition">
                            Update Reward
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app-layout>