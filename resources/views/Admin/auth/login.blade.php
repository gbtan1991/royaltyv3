<x-layouts.guest-layout>
<div class="max-w-md mx-auto mt-20 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-5">Admin Login</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-2 rounded mb-3">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Username</label>
            <input type="text" name="username" class="w-full border rounded p-2" value="{{ old('username') }}">
        </div>

        <div>
            <label class="block font-medium">Password</label>
            <input type="password" name="password" class="w-full border rounded p-2">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login
        </button>
    </form>
</div>



</x-layouts.guest-layout>