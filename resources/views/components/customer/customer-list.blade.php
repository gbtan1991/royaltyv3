<div class="p-4 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Customer List</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Username</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Gender</th>
                <th class="p-2 border">Birthdate</th>
                <th class="p-2 border">Registered</th>
                <th class="p-2 border">Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="p-2 border">{{ $customer->id }}</td>
                    <td class="p-2 border">{{ $customer->username }}</td>
                    <td class="p-2 border">{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td class="p-2 border">{{ $customer->gender }}</td>
                    <td class="p-2 border">{{ $customer->birthdate }}</td>
                    <td class="p-2 border">{{ $customer->date_of_registration }}</td>
                    <td class="p-2 border">{{ $customer->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>