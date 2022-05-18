<span class="font-weight-bold badge badge-pill badge-{{ 
    $unit->beekeepers->count() == 0 ? 'danger' : 'success'  }}">
    {{  $unit->beekeepers->count()}}
</span>