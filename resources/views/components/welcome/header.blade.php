<header class="bg-white ">
    <div x-data="{ open: false }" class="max-w-7xl mx-auto px-6 py-6">


        <div class="lg:hidden flex items-center justify-between">
            {{-- Logo for large screens --}}
            @once
            @include('components.welcome.logo')
            @endonce
            {{-- Logo for small screens --}}

            {{-- Hamburger menu for small screens --}}
            <button @click="open = !open" class="lg:hidden text-[#8058f3] focus:outline-none">
                <!-- Hamburger icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>




        {{-- Mobile Menu --}}
        <div x-show="open" x-transition class="lg:hidden flex flex-col px-6 pb-4 space-y-4 mt-5">
            @once
            @include('components.welcome.navigation')
            @include('components.welcome.c-t-a-button')
            @endonce
        </div>



        {{-- Desktop Menu --}}
        <div class="hidden lg:flex justify-between items-center">
            @once
            @include('components.welcome.logo')
            @include('components.welcome.navigation')
            @include('components.welcome.c-t-a-button')
            @endonce
        </div>




    </div>
</header>
