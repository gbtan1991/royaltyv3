<x-layouts.app-layout>

    <h3>List of Admins</h3>


    <a href="{{ route('admin.create') }}">Add new Admin</a>
    <a href="{{ route('dashboard') }}" class="mb-4 inline-block text-blue-600 hover:underline">Back to Dashboard</a>


    <x-admin.admin-list :admins="$admins" />



</x-layouts.app-layout>
