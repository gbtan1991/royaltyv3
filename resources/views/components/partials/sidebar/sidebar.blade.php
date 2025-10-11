<aside
    :class="sidebarToggle ? 'translate-x-0 lg:w-[290px]' : '-translate-x-full lg:translate-x-0 lg:w-[90px]'"
    class="sidebar fixed top-0 left-0 z-50 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 transition-all duration-300 ease-in-out
           lg:static lg:translate-x-0"
>
    <div>
        <x-partials.sidebar.sidebar-header />

        
    </div>
</aside>

