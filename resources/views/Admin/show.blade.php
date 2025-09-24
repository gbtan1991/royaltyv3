<x-layouts.app-layout>
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 shadow rounded">
    <h1 class="text-2xl font-bold mb-4">Admin Details</h1>

    <p><strong>ID:</strong> {{ $admin->id }}</p>
    <p><strong>Username:</strong> {{ $admin->username }}</p>
    <p><strong>Name:</strong> {{ $admin->full_name }}</p>
    <p><strong>Birthdate:</strong> {{ $admin->birthdate }}</p>
    <p><strong>Type:</strong> {{ ucfirst($admin->account_type) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($admin->account_status) }}</p>

    @if($admin->avatar)
        <div class="mt-4">
            <img src="{{ asset('storage/'.$admin->avatar) }}" alt="Avatar" class="w-32 h-32 rounded-full">
        </div>
    @endif

    <div class="mt-6 space-x-2">
        <a href="{{ route('admins.edit', $admin) }}" class="bg-yellow-600 text-white px-4 py-2 rounded">Edit</a>
        <a href="{{ route('admins.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Back</a>
    </div>
</div>


</x-layouts.app-layout>