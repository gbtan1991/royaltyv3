<x-layouts.app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg mt-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Add New Customer</h2>

        {{-- Consolidated Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('customer.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- LEFT COLUMN: PERSONAL IDENTITY (Users Table) --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-blue-600">Personal Identity</h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name *</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}" 
                               class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @enderror">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name *</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}" 
                               class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @enderror">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Birth Date *</label>
                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" 
                                   class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Gender</label>
                            <select name="gender" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- RIGHT COLUMN: LOYALTY DETAILS (Customer Profile Table) --}}
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold text-blue-600">Loyalty Account</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Member ID / Customer ID *</label>
                        <input type="text" name="member_id" value="{{ old('member_id') }}" 
                               placeholder="e.g. CUST-2025-0001"
                               class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500 @error('customer_id') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">This should be a unique identifier.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Loyalty Tier *</label>
                        <select name="loyalty_tier" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                            @foreach(['Bronze', 'Silver', 'Gold', 'Platinum'] as $tier)
                                <option value="{{ $tier }}" {{ old('loyalty_tier') == $tier ? 'selected' : '' }}>{{ $tier }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Account Status</label>
                        <select name="status" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-500">
                            <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ old('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end space-x-3">
                <a href="{{ route('customer.index') }}" class="px-6 py-2 text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 shadow-md transition">
                    Register Customer
                </button>
            </div>
        </form>
    </div>
</x-layouts.app-layout>