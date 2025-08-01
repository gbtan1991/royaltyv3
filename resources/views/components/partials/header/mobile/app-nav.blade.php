<div :class="menuToggle ? 'flex' : 'hidden'"
    class="shadow-theme-md w-full items-center justify-between gap-4 px-5 py-4 lg:flex lg:justify-end lg:px-0 lg:shadow-none">

    <div class="2xsm:gap-3 flex items-center gap-2">

        @include('components.partials.header.dark-mode-toggler')
        @include('components.partials.header.notification-button')
        @include('components.partials.header.user-profile')
    </div>
</div>
