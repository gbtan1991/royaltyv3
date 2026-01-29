<aside class="fixed top-0 left-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 lg:static lg:translate-x-0">
    

    <!--- SIDEBAR HEADER --->
    <div class="flex items-center gap-2 pt-8 pb-7">
        <a href="{{ route('dashboard') }}" >
            <img src="{{  asset('assets/images/royalty-logo-light.png') }}" class="w-38" alt="logo">

        </a>
    </div>
    <!--- END SIDEBAR HEADER --->


    <!--- SIDEBAR MENU --->
    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        
        
        <x-partials.nav-bar />

    </div>
    <!--- END SIDEBAR MENU --->


</aside>