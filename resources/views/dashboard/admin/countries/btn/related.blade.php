<span class="font-weight-bold badge badge-pill badge-{{ 
    $country->provinces->count() == 0 ? 'danger' : 'success'  }}">
    {{ $country->provinces->count()}}
</span>