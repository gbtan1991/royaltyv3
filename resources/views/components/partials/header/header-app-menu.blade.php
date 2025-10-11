<div
    class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 ">
    <x-partials.header.toggle-button target="sidebarToggle" iconDefault="fa-bars-staggered" iconActive="fa-xmark" size="10" />

    <a href={{ route('dashboard') }}" class="block lg:hidden">
        <span class="logo">
            <x-partials.header.app-logo />
        </span>
    </a>

    <div class="block lg:hidden">
    <x-partials.header.toggle-button target="menuToggle" iconDefault="fa-ellipsis-vertical" iconActive="fa-ellipsis-vertical" size="10" borderRadius="rounded-full"/>
    </div>

</div>
