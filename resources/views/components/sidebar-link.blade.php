@props(['active' => false])

<a
    {{ $attributes }}
    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
        {{ $active
            ? 'bg-indigo-600 text-white'
            : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}"
>
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        {{ $icon }}
    </svg>
    {{ $slot }}
</a>
