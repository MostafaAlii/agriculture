<span class="font-weight-bold badge badge-pill badge-{{ 
    $fservice->agriTServices->count() == 0 ? 'danger' : 'success'  }}">
    {{  $fservice->agriTServices->count() }}
    </span>