 
 <a href="{{ route('dashboard') }}" class="hidden lg:flex">
   
    <span class="logo flex items-center gap-2" :class="sidebarToggle ? 'hidden' : ''">
    
    <img class="h-10 bg-brand-500 p-1 rounded-xl" src="{{ asset('/images/crown-white.png')}}" alt="Logo" />
    <h1 class="text-xl font-semibold text-black dark:text-white">Royalty Rewards App</h1> 

    </span>

    <img class="logo-icon h-10 bg-brand-500 p-1 rounded-xl" :class="sidebarToggle ? 'lg:block' : 'hidden'" 
      src="{{ asset('/images/crown-white.png')}}" alt="Logo" />

 </a>
 
 
   