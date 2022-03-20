<span class="font-weight-bold badge badge-pill badge-{{ 
    $state->villages->count() == 0 ? 'danger' : 'success'  }}">
    {{ $state->villages->count() }}
</span>