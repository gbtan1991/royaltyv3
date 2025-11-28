<x-layouts.guest-layout>

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
    
        <h2>Welcome Admin</h2>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <button type="submit" class="">Login</button>
    </form>

    <!-- validation errors -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-layouts.guest-layout>