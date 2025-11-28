<x-layouts.guest-layout>

    <form action="" method="POST">
        @csrf
    
        <h2>Welcome Admin</h2>
        <label for="username">Username</label>
        <input type="text" name="username" id="username" placeholder="Username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <button type="submit" class="">Login</button>
    </form>


</x-layouts.guest-layout>