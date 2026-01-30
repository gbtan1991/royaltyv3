<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 lg:static lg:translate-x-0">


    <!--- SIDEBAR HEADER --->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'" class="flex items-center gap-2 pt-8 pb-7">

        <a href="{{ route('dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img src="{{ asset('assets/images/royalty-logo-light.png') }}" class="w-38" alt="logo">
            </span>

            <img class="logo-icon w-8" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('assets/images/logo.png') }}" alt="Logo" />
        </a>
    </div>
    <!--- END SIDEBAR HEADER --->


    <!--- SIDEBAR MENU --->
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <x-partials.navbar />

    </div>
    <!--- END SIDEBAR MENU --->


</aside>
