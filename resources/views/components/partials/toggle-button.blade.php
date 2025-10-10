<button
    @click.stop="sidebarToggle = !sidebarToggle"
    :class="sidebarToggle ? 'bg-gray-100' : ''"
    class="z-50 flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-500 lg:h-11 lg:w-11"
>
    <!-- Hamburger icon -->
    <i
      class="fa-solid fa-bars-staggered"
      x-show="sidebarToggle"
      x-transition
    ></i>

    <!-- Close icon -->
    <i
      class="fa-solid fa-xmark"
      x-show="!sidebarToggle"
      x-transition
    ></i>

</button>
