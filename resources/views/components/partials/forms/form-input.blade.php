@props([

    'id' => null,
    'name',
    'type' => 'text',
    'value' => null,
    'placeholder' => '',
    'class',

])


<input 
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    type="{{ $type }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => $class]) }}

/>

@error($name)
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror