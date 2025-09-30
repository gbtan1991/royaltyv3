<x-layouts.app-layout>

    <div class="max-w-lg mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-5">Create Admin</h1>

    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <x-form-label for="username" value="Username" class="block font-medium" />
            <x-form-input name="username" class="w-full border rounded p-2" value="{{ old('username') }}" />
        </div>

        <div>
            <x-form-label for="password" value="Password" class="block font-medium" />
            <x-form-input type="password" name="password" class="w-full border rounded p-2" />
        </div>

        <div>
            <x-form-label for="confirm_password" value="Confirm Password" class="block font-medium" />
            <x-form-input type="password" name="confirm_password" class="w-full border rounded p-2" />
            </div>

        <div>
            <x-form-label for="first_name" value="First Name" class="block font-medium" />
            <x-form-input name="first_name" class="w-full border rounded p-2" value="{{ old('first_name') }}" />
        </div>

        <div>
            <x-form-label for="last_name" value="Last Name" class="block font-medium" />
            <x-form-input name="last_name" class="w-full border rounded p-2" value="{{ old('last_name') }}" />
        </div>

        <div>
            <x-form-label for="birthdate" value="Birthdate" class="block font-medium" />
            <x-form-input type="date" name="birthdate" class="w-full border rounded p-2" value="{{ old('birthdate') }}" />
        </div>

        <div>
            <x-form-label for="account_type" value="Account Type" class="block font-medium" />
            <x-form-select name="account_type" :options="['superadmin' => 'Super Admin', 'admin' => 'Admin']" value="user" class="" required />
            
        </div>

        <div>
            <x-form-label for="avatar" value="Avatar" class="block font-medium" />
            <x-form-input type="file" name="avatar" class="w-full border rounded p-2" />
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Create</button>
        <a href="{{ route('admin.index')}}">Back to Admin List</a>
    </form>
</div>
    


</x-layouts.app-layout> 