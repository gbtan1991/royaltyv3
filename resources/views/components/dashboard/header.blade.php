<header x-data="{ menuToggle: false }"
    class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white lg:border-b dark:border-gray-800 dark:bg-gray-900">
    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
      
      
      
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4 dark:border-gray-800">

            @include('components.dashboard.partials.header.hamburger-button')
            @include('components.dashboard.partials.header.mobile.mobile-hamburger-button')
            @include('components.dashboard.partials.header.mobile.mobile-app-logo')
            @include('components.dashboard.partials.header.mobile.app-nav-button')
            @include('components.dashboard.partials.header.search-bar')

      
        </div>
    
        @include('components.dashboard.partials.header.mobile.app-nav')
{{--       
      @include('components.partials.header.mobile.menu-toggle') --}}

    </div>


</header>
