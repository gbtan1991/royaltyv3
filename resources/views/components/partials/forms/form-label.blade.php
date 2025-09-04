<label {{ $attributes->merge(['class' => 'mb-1.5 block text-sm font-medium text-gray-700'])}}>
    {{ $slot }}

    @if ($required ?? false)
        <span class="text-red-500">*</span>
    @endif

</label>