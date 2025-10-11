<button @click.stop="{{ $target }} = !{{ $target }}" :class="{{ $target }} ? '' : ''"
    class="z-50 flex h-{{ $size }} w-{{ $size }} items-center justify-center  border {{ $borderRadius }} border-gray-200 text-gray-500 lg:h-{{ (int) $size + 1 }} lg:w-{{ (int) $size + 1 }}">
    <!-- Default Button -->
    <i class="fa-solid {{ $iconDefault }}" x-show="!{{ $target }}" x-transition></i>

    <!-- Active Button icon -->
    <i class="fa-solid {{ $iconActive }}" x-show="{{ $target }}" x-transition></i>

</button>
