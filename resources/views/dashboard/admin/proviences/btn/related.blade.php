<span class="font-weight-bold badge badge-pill badge-{{ 
    $provience->areas->count() == 0 ? 'danger' : 'success'  }}">
    {{ $provience->areas->count(); }}
</span>