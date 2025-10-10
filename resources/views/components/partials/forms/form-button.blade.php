@props([
    'type' => 'submit',
    'class' => '',
    'disabled' => false,    
    'variant' => 'primary',
])

<button type="{{ $type }}" {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $class]) }}>
    {{ $slot }}
</button>