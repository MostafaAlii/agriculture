<span class="font-weight-bold badge badge-pill badge-{{ 
    $area->states->count() == 0 ? 'danger' : 'success'  }}">
    {{ $area->states->count() }}
</span>