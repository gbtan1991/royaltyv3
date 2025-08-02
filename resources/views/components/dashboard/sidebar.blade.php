<aside 
    x-transition:enter="transition-transform duration-300"
    x-transition:enter-start="-translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition-transform duration-200"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full"
    x-show="sidebarToggle || window.innerWidth >= 1024" 
    :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed top-0 z-99999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-500 dark:bg-black lg:static lg:translate-x-0 transition-all ease-in-out"
>

    
@include('components.dashboard.partials.header.desktop.sidebar-header')

<div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">

@include('components.dashboard.partials.header.desktop.sidebar-menu')

</div>


</aside>