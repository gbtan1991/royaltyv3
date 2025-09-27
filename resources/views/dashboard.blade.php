<x-layouts.app-layout>

    <div class="max-w-3xl mx-auto mt-10">
    <h1 class="text-2xl font-bold">Welcome, {{ auth('admin')->user()->full_name }} 🎉</h1>

    <form action="{{ route('admin.logout') }}" method="POST" class="mt-4">
        @csrf
        <button class="bg-red-600 text-white px-4 py-2 rounded">Logout</button>
    </form>
</div>
</x-layouts.app-layout>