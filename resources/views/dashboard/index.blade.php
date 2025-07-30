<x-layouts.guest-layout>
    <div class="text-center mt-20">
        <h1 class="text-3xl font-bold text-gray-800">Welcome to the Admin Dashboard</h1>
        <p class="mt-4 text-gray-600">You are logged in as: <strong>{{ Auth::guard('admin')->user()->username }}</strong></p>
        
        <form method="POST" action="{{ route('admin.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
    </div>
</x-layouts.guest-layout>
