<x-layouts.app-layout>

    <div class="max-w-lg mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Create Admin</h1>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <x-form-label for="username" value="Username" class="block font-medium" />
            <input type="text" name="username" class="w-full border rounded p-2" value="{{ old('username') }}">
            @error('username') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-form-label for="password" value="Password" class="block font-medium" />
            <input type="password" name="password" class="w-full border rounded p-2">
            @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-form-label for="confirm_password" value="Confirm Password" class="block font-medium" />
            <input type="password" name="password_confirmation" class="w-full border rounded p-2">
        </div>

        <div>
            <x-form-label for="first_name" value="First Name" class="block font-medium" />
            <input type="text" name="first_name" class="w-full border rounded p-2" value="{{ old('first_name') }}">
            @error('first_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-form-label for="last_name" value="Last Name" class="block font-medium" />
            <input type="text" name="last_name" class="w-full border rounded p-2" value="{{ old('last_name') }}">
            @error('last_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div>
            <x-form-label for="birthdate" value="Birthdate" class="block font-medium" />
            <input type="date" name="birthdate" class="w-full border rounded p-2" value="{{ old('birthdate') }}">
        </div>

        <div>
            <x-form-label for="account_type" value="Account Type" class="block font-medium" />
            <select name="account_type" class="w-full border rounded p-2">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>

        <div>
            <x-form-label for="avatar" value="Avatar" class="block font-medium" />
            <input type="file" name="avatar" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Create</button>
    </form>
</div>
    


</x-layouts.app-layout> 