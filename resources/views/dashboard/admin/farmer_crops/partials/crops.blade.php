<table>
@foreach($crops as $crop)
    <tr>
        <td><input {{ $crop->value ? 'checked' : null }}
                   data-id="{{ $crop->id }}" type="checkbox"
                   class="crop-enable">
        </td>
        <td>{{ $crop->name }}</td>
        <td><input value="{{ $crop->value ?? null }}"
                   {{ $crop->value ? null : 'disabled' }} data-id="{{ $crop->id }}"
                   name="crops[{{ $crop->id }}]" type="text"
                   class="crop-area form-control" placeholder="Area">
        </td>
    </tr>
    @endforeach
    </table>

@section('js')
    @parent
    <script>
        $('document').ready(function () {
            $('.crop-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.crop-area[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.crop-area[data-id="' + id + '"]').val(null)
            })
        });
    </script>
@endsection