@props([
    'id' => null,
    'name',
    'options' => [],
    'value' => '',
    'placeholder' => 'Select an option',
    'class',

])

<select 
    id="{{ $id ?? $name }}"
    name="{{ $name }}"
    {{ $attributes->merge(['class' => $class]) }}

>

    
    @foreach($options as $key => $label)
        <option value="{{ $key }}" {{ (string) old($name, $value) === (string) $key ? 'selected' : '' }}>
            {{ $label }}
        </option>
    @endforeach

</select>

@error($name)
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
