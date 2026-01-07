<x-layouts.app-layout>
    <h3>List of Transactions</h3>

    <a href="{{ route('transaction.create') }}">Add new transaction</a>
    <a href="{{ route('dashboard') }}" class="mb-4 inline-block text-blue-600 hover:underline">Back to Dashboard</a><br>

    <x-transaction.sales.transaction-list :transactions="$transactions" />

</x-layouts.app-layout> 