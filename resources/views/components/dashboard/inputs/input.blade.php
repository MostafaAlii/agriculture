@props(['id', 'name', 'type' => 'text', 'label', 'value' => '', 'placeholder'])
<label for="{{ $id ?? $name }}">
    {{ $label }}
</label>
<input type="{{ $type }}" id="{{ $id ?? $name }}"
       name="{{ $name }}"
       value="{{ old($name, $value) }}"
       placeholder="{{$placeholder ?? $label }}"
       {{ $attributes->class([]) }}
>
@error($name)
    <small class="form-text text-danger">{{$message}}</small>
@enderror
