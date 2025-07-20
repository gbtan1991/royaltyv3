<x-layouts.guest-layout>

    <h2 class="text-2xl font-semibold mb-4">Admin Register</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.auth.register') }}">
        @csrf

        <div class="mb-4">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="password">Password:</label>
            <input type="password" name="password" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-6">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required class="block w-full border px-2 py-1">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Register</button>
    </form>

</x-layouts.guest-layout>
