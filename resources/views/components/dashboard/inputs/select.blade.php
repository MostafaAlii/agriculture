@props(['id', 'label', 'name', 'options' => [], 'selected' => '', 'no_data_found' => ''])
<label for="{{ $id ?? $name }}">
    {{ $label }}
</label>
<select id="{{ $id ?? $name }}"
       name="{{ $name }}"
       {{ $attributes->class([]) }}
>
    @forelse($options as $value => $text)
        <option value="{{$value}}" @if($value == old($name, $selected)) selected @endif>
            {{$text}}
        </option>
        @empty
            <small class="form-text text-danger">{{$no_data_found}}</small>
    @endforelse
</select>
@error($name)
    <small class="form-text text-danger">{{$message}}</small>
@enderror
