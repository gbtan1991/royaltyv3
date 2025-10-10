<div 
    :class="sidebarToggle ? '' : ''"
    class="sidebar-header flex items-center gap-2 pt-8 pb-7">

    <a href="{{ route('dashboard')}}">
        <span class="logo" :class="sidebarToggle ? 'hidden': ''">
            <img src="{{ asset('assets/images/royalty-logo-light.png')}}" alt="logo" class="ml-3"/>
        </span>
    </a>

</div>