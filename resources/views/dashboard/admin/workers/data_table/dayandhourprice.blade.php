

<h3 class="font-weight-bold badge badge-pill badge-{{
    $worker->daily_price != null ? 'success' : 'info'  }}" style="font-size: 15px;">
   {{ $worker->daily_price != null ?  '$' . number_format($worker->daily_price,2)   : '$' . number_format($worker->hourly_price,2) }}
</h3>
