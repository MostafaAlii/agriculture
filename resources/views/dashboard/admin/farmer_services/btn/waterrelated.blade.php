<span class="font-weight-bold badge badge-pill badge-{{ 
    $fservice->waterServices->count() == 0 ? 'danger' : 'success'  }}">
    {{  $fservice->waterServices->count() }}
    </span>