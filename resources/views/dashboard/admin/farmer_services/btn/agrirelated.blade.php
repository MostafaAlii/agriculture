<span class="font-weight-bold badge badge-pill badge-{{ 
    $fservice->agriServices->count() == 0 ? 'danger' : 'success'  }}">
    {{  $fservice->agriServices->count() }}
</span>