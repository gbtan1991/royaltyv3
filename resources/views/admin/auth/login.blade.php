


<x-layouts.guest-layout>

    <div class="relative p-6 bg-white z-1 sm:p-0">
        <div class="relative flex flex-col justify-center w-full h-screen lg:flex-row">
            <div class="flex flex-col flex-1 w-full lg:w-1/2 my-auto">
                <div class="w-full max-w-md pt-10 mx-auto">
                    <a href="{{ route('welcome') }}" class="flex items-center gap-1 text-sm text-gray-500 transition-colors hover:text-gray-700">
                        <i class="fa-solid fa-angle-left"></i>
                        Back to Introduction
                    </a>
                </div>

                <div class="w-full max-w-md mx-auto mt-8">
                    @if (session('error'))
                        <p class="text-red-500">{{ session('error') }}</p>
                    @endif

                    <!-- Call the LoginForm component -->
                      @include('components.auth.login-form')    
                </div>
            </div>

            <div class="relative items-center hidden w-full h-full bg-[#130f30] lg:grid lg:w-1/2">
        <div class="flex items-center justify-center z-1">
            @include('components.auth.common-grid-shape')
            <div class="flex flex-col items-center max-w-xs">
              <a href="index.html" class="block mb-4">
                <img src="{{ asset('images/crown-white.png')}}" alt="Logo" />
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
