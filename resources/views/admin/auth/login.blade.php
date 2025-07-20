<x-layouts.guest-layout>

    <h2>Admin Login</h2>

    @if (session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif

    <form method="POST" action="">
        @csrf

        <div>
            <label>Email:</label>
            <input type="email" name="email" class="block w-full" required>
        </div>

        <div class="mt-4">
            <label>Password:</label>
            <input type="password" name="password" class="block w-full" required>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                Login
            </button>
        </div>
    </form>

</x-layouts.guest-layout>
