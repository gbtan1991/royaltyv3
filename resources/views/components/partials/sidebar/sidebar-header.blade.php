<div class="hidden lg:flex">
<div 
    :class="sidebarToggle ? 'justify-center' : 'justify-between'"
    class="sidebar-header flex items-center gap-2 pt-8 pb-7">

    <a href="{{ route('dashboard')}}">

        <img 
        src={{ asset('assets/images/logo.png')}} 
        alt="logo"
        :class="sidebarToggle ? '' : 'hidden'"
        "/>

        <span class="logo" :class="sidebarToggle ? 'hidden': ''">
        <x-partials.header.logos />
       </span>

     
    </a>

</div>
</div>