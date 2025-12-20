<x-layouts.app-layout>

    <h3>List of Customers</h3>

{{-- 
    <a href="{{ route('customer.create') }}">Add new Admin</a> --}}
    <a href="{{ route('dashboard') }}" class="mb-4 inline-block text-blue-600 hover:underline">Back to Dashboard</a>


    <x-customer.customer-list :customers="$customers" />



</x-layouts.app-layout>
