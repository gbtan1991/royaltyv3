<x-layouts.guest-layout>


<form>
<div>
<x-partials.form.form-label for="username" required>Username</x-partials.form.form-label>
<x-partials.form.form-input type="text" name="username" value="" id="username" placeholder="Enter your username" required autofocus autocomplete="username" />

</div>


<x-partials.form.form-label for="password">Password</x-partials.form.form-label>
<x-partials.form.form-input type="password" name="password" value="" id="password" placeholder="Enter your password" required autocomplete="current-password" />



</form>
</x-layouts.guest-layout>