<span class="font-weight-bold badge badge-pill badge-{{ 
    $land_area->count() == 0 ? 'danger' : 'success'  }}">
    {{ $land_area->count()}}
</span>