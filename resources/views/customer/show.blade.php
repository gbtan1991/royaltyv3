<x-layouts.app-layout>

    <h1 class="text-2xl font-bold mb-6 text-gray-800">Customer Details</h1>

    <div class="bg-white p-8 shadow-md rounded-lg w-full max-w-2xl">

        {{-- Profile Avatar Section --}}
        <div class="flex flex-col items-center mb-8 border-b pb-6">
            <img src="{{ app(\Laravolt\Avatar\Avatar::class)->create($customer->user->first_name . ' ' . $customer->user->last_name)->toBase64() }}"
                class="w-28 h-28 rounded-full shadow-sm mb-3" />
            <h2 class="text-xl font-semibold">{{ $customer->user->first_name }} {{ $customer->user->last_name }}</h2>
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full uppercase">
                {{ $customer->loyalty_tier }} Member
            </span>
        </div>

        {{-- Details Table --}}


        <table class="w-full text-left">
            <tr class="border-b">
                <th class="py-3 w-48 text-gray-600 font-medium">Member ID</th>
                <td class="py-3 font-mono text-blue-600">{{ $customer->member_id}}</td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Full Name</th>
                <td class="py-3">{{ $customer->user->first_name }} {{ $customer->user->last_name }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Gender</th>
                <td class="py-3">{{  $customer->user->gender }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Birthdate</th>
                <td>{{ ucfirst($customer->user->birth_date) }}</td>
            
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Loyalty Tier</th>
                <td class="py-3">
                    {{ $customer->loyalty_tier }}
                    </td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Account Status</th>
                <td class="py-3">
                    {{ $customer->status }}
                </td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Last Activity</th>
                <td class="py-3">{{ $customer->last_activity_at }}</td>
            </tr>

            <tr class="border-b">
                <th class="py-3 text-gray-600 font-medium">Registered By</th>
                <td class="py-3 text-sm">
                   {{-- {{ $customer->registeredBy->first_name }} {{ $customer->registeredBy->last_name }} --}}
                    <span class="text-gray-400 block text-xs">on {{ $customer->created_at }}</span>
                </td>
            </tr>
        </table>

        {{-- Actions --}}
        <div class="mt-8 flex items-center gap-3">
            <a href="{{ route('customer.edit', $customer) }}" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                Edit Member
            </a>
            
            <form action="{{ route('customer.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this customer? This will also remove their identity record.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-6 py-2 bg-red-100 text-red-600 rounded hover:bg-red-600 hover:text-white transition">
                    Delete
                </button>
            </form>

            <a href="{{ route('customer.index') }}" class="ml-auto px-6 py-2 bg-gray-100 text-gray-600 rounded hover:bg-gray-200 transition">
                Back to List
            </a>
        </div>

    </div>
</x-layouts.app-layout>