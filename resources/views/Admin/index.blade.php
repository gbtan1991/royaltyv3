<x-layouts.app-layout>
    

    <div class="max-w-5xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-5">Admins</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
    

    <a href="{{ route('admin.create')}}" class="bg-blue-600 text-white px-4 py-2 rounded">Add New Admin</a>

    <table class="w-full mt-5 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Username</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Type</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr>
                    <td class="border px-4 py-2">{{ $admin->id }}</td>
                    <td class="border px-4 py-2">{{ $admin->username }}</td>
                    <td class="border px-4 py-2">{{ $admin->full_name }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($admin->account_type) }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($admin->account_status) }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <a href="{{ route('admin.show', $admin) }}" class="text-blue-600">View</a>
                        <a href="{{ route('admin.edit', $admin) }}" class="text-yellow-600">Edit</a>
                        <form action="{{ route('admin.destroy', $admin) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this admin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">No admins found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $admins->links() }}
    </div>

</div>
</x-layouts.app-layout>