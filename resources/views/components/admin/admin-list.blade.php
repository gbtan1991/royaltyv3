


<div class="p-4 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Customer List</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Avatar</th>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Username</th>
                <th class="p-2 border">Full Name</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">last Login</th>
                <th class="p-2 border">Locked Until</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Actions</th>
                
                

            </tr>
        </thead>
       <tbody>
    @foreach ($admins as $admin) 
    <tr>
        <td class="p-2 border">
            <img src="{{ app(\Laravolt\Avatar\Avatar::class)->create($admin->user->first_name . ' ' . $admin->user->last_name)->toBase64() }}" 
                 class="w-10 h-10 rounded-full"/>
        </td>
        
        <td class="p-2 border">{{ $admin->employee_id }}</td>
        
        <td class="p-2 border font-semibold">{{ $admin->username }}</td>

        <td class="p-2 border">
            {{ $admin->user->first_name }} {{ $admin->user->last_name }}
        </td>

        <td class="p-2 border">
            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                {{ $admin->role }}
            </span>
        </td>

        <td class="p-2 border text-sm text-gray-600">
            {{ $admin->last_login_at ?? 'Never' }}
        </td>

        <td class="p-2 border text-sm">
            {{ $admin->locked_until ?? 'N/A' }}
        </td>

        <td class="p-2 border">
            {{ $admin->status }}
        </td>

        <td class="p-2 border">
            <a href="{{ route('admin.show', $admin) }}" class="text-blue-600 hover:underline">View/Edit</a>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>