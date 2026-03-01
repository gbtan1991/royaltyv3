<header 
    x-data="{appMenuToggle: false}"
class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white lg:border-b dark:bg-gray-900">
    <div class="flex grow flex-col items-center justify-between lg:flex-row lg:px-6">
        <div
            class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 sm:gap lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4">

            <x-partials.hamburger-button />

            <!-- Mobile Logo -->
            <a href="{{ route('dashboard') }}" class="lg:hidden">

                <img class="dark:hidden" src="{{ asset('assets/images/royalty-logo-dark.png') }}" alt="Logo" />
                <img class="hidden dark:block w-38" src="{{ asset('assets/images/royalty-logo-light.png') }}"
                    alt="Logo" />
            </a>
            <!-- Mobile Logo End -->

            <!-- Application nav menu button -->
            <button
                class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 lg:hidden dark:text-gray-400 dark:hover:bg-gray-800"
                :class="appMenuToggle ? 'bg-gray-100' : ''" @click.stop="appMenuToggle = !appMenuToggle">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z"
                        fill="" />
                </svg>
            </button>
            <!-- Application nav menu button End-->

            <x-partials.search-bar />

             <x-partials.dark-toggle-button />

          

        </div>


          <div :class="appMenuToggle ? 'flex' : 'hidden'"
          
          >
                test

            </div>
            
          
    </div>


</header>
