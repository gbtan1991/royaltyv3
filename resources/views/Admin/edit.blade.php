<x-layouts.app-layout>
<div class="max-w-lg mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Edit Admin</h1>

    <form action="{{ route('admins.update', $admin) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Username</label>
            <input type="text" name="username" class="w-full border rounded p-2" value="{{ old('username', $admin->username) }}">
        </div>

        <div>
            <label class="block font-medium">Password (leave blank to keep current)</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <div>
            <label class="block font-medium">First Name</label>
            <input type="text" name="first_name" class="w-full border rounded p-2" value="{{ old('first_name', $admin->first_name) }}">
        </div>

        <div>
            <label class="block font-medium">Last Name</label>
            <input type="text" name="last_name" class="w-full border rounded p-2" value="{{ old('last_name', $admin->last_name) }}">
        </div>

        <div>
            <label class="block font-medium">Birthdate</label>
            <input type="date" name="birthdate" class="w-full border rounded p-2" value="{{ old('birthdate', $admin->birthdate) }}">
        </div>

        <div>
            <label class="block font-medium">Account Type</label>
            <select name="account_type" class="w-full border rounded p-2">
                <option value="admin" {{ $admin->account_type == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ $admin->account_type == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>

        <div>
            <label class="block font-medium">Avatar</label>
            <input type="file" name="avatar" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="w-full bg-yellow-600 text-white py-2 rounded hover:bg-yellow-700">Update</button>
    </form>
</div>



</x-layouts.app-layout>