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
            <x-form-label for="username" value="Username" class="block font-medium "/>
            <x-form-input name="username" class="w-full border rounded p-2" value="{{ old('username') }}"/>
        </div>

        <div>
            <x-form-label for="password" value="Password" class="block font-medium"/>
            <x-form-input name="password" type="password" autocomplete="new-password" class="w-full border rounded p-2" value="{{ old('username') }}"/>
        </div>


        <x-form-button type="submit" class="bg-brand-500 text-white py-2 rounded hover:bg-brand-700 w-full">
            Login
        </x-form-button>
      
    </form>
</div>



</x-layouts.guest-layout>