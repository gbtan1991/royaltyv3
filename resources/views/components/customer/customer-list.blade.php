<div class="p-4 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Customer List</h2>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">Avatar</th>
                <th class="p-2 border">Member ID</th>
                <th class="p-2 border">Full Name</th>
                <th class="p-2 border">Gender</th>
                <th class="p-2 border">Birthdate</th>
                <th class="p-2 border">Registered</th>
                <th class="p-2 border">Total Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td class="p-2 border">
                        <img src="{{ app( \Laravolt\Avatar\Avatar::class)->create($customer->user->first_name . ' ' . $customer->user->last_name)->toBase64()}}"
                            class="w-10 h-10 rounded-full" />
                    </td>

                    <td class="p-2 border">{{ $customer->member_id }}</td>
                    <td class="p-2 border font-semibold">{{ $customer->user->first_name }} {{ $customer->user->last_name }}</td>
                    <td class="p-2 border">{{ $customer->user->gender }}</td>
                    <td class="p-2 border">{{ $customer->user->birth_date }}</td>
                    <td class="p-2 border">{{ $customer->user->created_at }}</td>
                    <td class="p-2 border"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>