<x-layouts.app-layout>


    <form action="{{ route('logout.post') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

</x-layouts.app-layout>