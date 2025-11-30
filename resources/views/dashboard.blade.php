<x-layouts.app-layout>

    <h1>Admin Dashboard</h1>

    <x-partials.nav-bar />

    <form action="{{ route('logout.post') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

</x-layouts.app-layout>