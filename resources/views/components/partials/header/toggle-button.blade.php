<button @click.stop="{{ $target }} = !{{ $target }}" :class="{{ $target }} ? '' : ''"
    @class([
        'z-50 flex items-center justify-center border text-gray-400 border-gray-200',
        $borderRadius,
        match($size) {
            '8' => 'h-8 w-8 lg:h-9 lg:w-9',
            '10' => 'h-10 w-10 lg:h-11 lg:w-11',
            '12' => 'h-12 w-12 lg:h-13 lg:w-13',
            default => 'h-10 w-10 lg:h-11 lg:w-11',
        },
    ]) >
    
    <!-- Default Button -->
    <i class="fa-solid {{ $iconDefault }}" x-show="!{{ $target }}" x-transition></i>

    <!-- Active Button icon -->
    <i class="fa-solid {{ $iconActive }}" x-show="{{ $target }}" x-transition></i>

</button>
