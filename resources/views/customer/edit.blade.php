<x-layouts.app-layout>

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Edit Customer</h1>

    

    <div class="bg-white p-8 shadow-md rounded-lg w-full max-w-2xl">

        {{-- Global Error/Success Alerts --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                <p class="font-bold">Please correct the following errors:</p>
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('customer.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Profile Avatar Section --}}
            <div class="flex flex-col items-center mb-8 border-b pb-6">
                <img src="{{ app(\Laravolt\Avatar\Avatar::class)->create($customer->user->first_name . ' ' . $customer->user->last_name)->toBase64() }}"
                    class="w-28 h-28 rounded-full shadow-sm mb-3" />
                <h2 class="text-xl font-semibold">{{ $customer->user->first_name }} {{ $customer->user->last_name }}</h2>
            </div>

            {{-- Details Table --}}
            <table class="w-full text-left">
                <tr class="border-b">
                    <th class="py-3 w-48 text-gray-600 font-medium">Member ID</th>
                    <td class="py-3 font-mono text-gray-400">
                        {{ $customer->member_id }}
                        <input type="hidden" name="member_id" value="{{ $customer->member_id }}">
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">First Name</th>
                    <td class="py-3">
                        <input type="text" name="first_name" value="{{ old('first_name', $customer->user->first_name) }}" 
                               class="w-full border rounded px-2 py-1 @error('first_name') border-red-500 @enderror">
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">Last Name</th>
                    <td class="py-3">
                        <input type="text" name="last_name" value="{{ old('last_name', $customer->user->last_name) }}" 
                               class="w-full border rounded px-2 py-1 @error('last_name') border-red-500 @enderror">
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">Gender</th>
                    <td class="py-3">
                        <select name="gender" class="w-full border rounded px-2 py-1">
                            <option value="male" {{ old('gender', $customer->user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender', $customer->user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender', $customer->user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">Birthdate</th>
                    <td class="py-3">
                        <input type="date" name="birth_date" value="{{ old('birth_date', $customer->user->birth_date ? \Carbon\Carbon::parse($customer->user->birth_date)->format('Y-m-d') : '') }}" 
                               class="w-full border rounded px-2 py-1">
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">Loyalty Tier</th>
                    <td class="py-3">
                        <select name="loyalty_tier" class="w-full border rounded px-2 py-1">
                            <option value="Bronze" {{ old('loyalty_tier', $customer->loyalty_tier) == 'Bronze' ? 'selected' : '' }}>Bronze</option>
                            <option value="Silver" {{ old('loyalty_tier', $customer->loyalty_tier) == 'Silver' ? 'selected' : '' }}>Silver</option>
                            <option value="Gold" {{ old('loyalty_tier', $customer->loyalty_tier) == 'Gold' ? 'selected' : '' }}>Gold</option>
                        </select>
                    </td>
                </tr>

                <tr class="border-b">
                    <th class="py-3 text-gray-600 font-medium">Account Status</th>
                    <td class="py-3">
                        <select name="is_active" class="w-full border rounded px-2 py-1">
                            <option value="1" {{ old('is_active', $customer->user->is_active) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $customer->user->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </td>
                </tr>
            </table>

            {{-- Actions --}}
            <div class="mt-8 flex items-center gap-3">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Save Changes
                </button>
                <a href="{{ route('customer.show', $customer) }}" class="ml-auto px-6 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts.app-layout>