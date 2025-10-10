@props(['for', 'value', 'class'])

<label for="{{ $for}}" {{ $attributes->merge(['class' => $class])}}>
    {{ $value ?? $slot }}
</label>