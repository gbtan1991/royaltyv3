<x-layouts.app-layout>

     <h1 class="text-2xl font-bold mb-6">Admin Details</h1>

    <div class="bg-white p-6 shadow rounded-lg w-full max-w-xl">
        
        {{-- Avatar --}}
        <div class="flex justify-center mb-4">
            <img 
                src="{{ app(\Laravolt\Avatar\Avatar::class)->create($adminProfile->first_name . ' ' . $adminProfile->last_name)->toBase64() }}"
                class="w-24 h-24 rounded-full"
            />
        </div>

        {{-- Details --}}
        <table class="w-full text-left">
            <tr>
                <th class="py-2 w-40">ID</th>
                <td>{{ $adminProfile->id }}</td>
            </tr>

            <tr>
                <th class="py-2">Username</th>
                <td>{{ $adminProfile->username }}</td>
            </tr>

            <tr>
                <th class="py-2">Full Name</th>
                <td>{{ $adminProfile->user->first_name }} {{ $adminProfile->user->last_name }}</td>
            </tr>

            <tr>
                <th class="py-2">Role</th>
                <td>{{ ucfirst($adminProfile->role) }}</td>
            </tr>

            <tr>
                <th class="py-2">Status</th>
                <td>{{ ucfirst($adminProfile->status) }}</td>
            </tr>

            <tr>
                <th class="py-2">Last Login</th>
                <td>{{ $adminProfile->last_login_at ?? 'Never' }}</td>
            </tr>

            <tr>
                <th class="py-2">Locked Until</th>
                <td>{{ $adminProfile->locked_until ?? 'Not locked' }}</td>
            </tr>
        </table>

        {{-- Actions --}}
        <div class="mt-6 flex gap-2">
            <a href="{{ route('admin.edit', $adminProfile) }}" 
               class="px-4 py-2 bg-blue-600 text-white rounded">
               Edit
            </a>

            <a href="{{ route('admin.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded">
               Back
            </a>
        </div>

    </div>
</x-layouts.app-layout>