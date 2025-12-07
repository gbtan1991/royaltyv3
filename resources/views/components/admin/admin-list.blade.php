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
                
                

            </tr>
        </thead>
        <tbody>
           @foreach ($admins as $admin) 
            <tr>
                <td class="p-2 border"><img src="{{ $admin->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full"></td>
                <td class="p-2 border">{{ $admin->id }}</td>
                <td class="p-2 border">{{ $admin->username }}</td>
                <td class="p-2 border">{{ $admin->first_name }} {{ $admin->last_name }}</td>
                <td class="p-2 border">{{ $admin->role }}</td>
                <td class="p-2 border">{{ $admin->last_login_at }}</td>
                <td class="p-2 border">{{ $admin->locked_until }}</td>
                <td class="p-2 border">{{ $admin->status }}</td>
            </tr>
              @endforeach
        </tbody>
    </table>
</div>