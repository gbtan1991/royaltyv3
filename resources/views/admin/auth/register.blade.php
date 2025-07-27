{{-- <x-layouts.guest-layout>
    
    <div class="relative p-6 bg-white z-1 sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen lg:flex-row">
            <div class="flex flex-col flex-1 w-full lg:w-1/2 my-auto">
                <div class="w-full max-w-md pt-10 mx-auto">
                    <a href="{{ route('admin.login') }}" class="flex items-center gap-1 text-sm text-gray-500 transition-colors hover:text-gray-700">
                        <i class="fa-solid fa-angle-left"></i>
                        Back to Login
                    </a>
                </div>

                <div class="w-full max-w-md mx-auto mt-8">
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif

                    <!-- Call the LoginForm component -->
                      @include('components.admin.register-form')    
                </div>
            </div>

            <div class="relative items-center hidden w-full h-full bg-[#130f30] lg:grid lg:w-1/2">
        <div class="flex items-center justify-center z-1">
            @include('components.admin.auth.common-grid-shape')
            <div class="flex flex-col item-center max-w-xs">
              <a href="{{ route('welcome')}}" class="flex flex-col items-center mb-2 ">
                <img src="{{ asset('images/crown-white.png')}}" alt="Logo" class="w-[80%] -mb-5" />
                <h1 class="text-3xl font-bold text-white">Royalty Rewards App</h1>
            </a>
              <p class="text-center text-gray-400 dark:text-white/60">
                Points Made Powerful. Rewards Made Easy.
              </p>
            </div>
            
        </div>
        </div>


        

    </div>


    </div>


</x-layouts.guest-layout>




<x-layouts.guest-layout>

    <h2 class="text-2xl font-semibold mb-4">Admin Register</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.register') }}">
        @csrf

        
        <div class="mb-4">
            <label for="username"> Username:</label>
            <input type="text" name="username" value="{{ old('username') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="{{ old('first_name') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" value="{{ old('last_name') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="email">Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-4">
            <label for="password">Password:</label>
            <input type="password" name="password" required class="block w-full border px-2 py-1">
        </div>

        <div class="mb-6">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" required class="block w-full border px-2 py-1">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Register</button>
    </form>

</x-layouts.guest-layout> --}}


<x-layouts.guest-layout>
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen dark:bg-gray-900 lg:flex-row">

               <!-- Call the LoginForm component -->
                    @include('components.admin.register-form')
                    @include ('components.admin.auth.common-grid')

        </div>


</x-layouts.guest-layout>