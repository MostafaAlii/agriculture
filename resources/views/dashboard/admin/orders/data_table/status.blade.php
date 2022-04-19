@if ($order->status == Order::ORDERED)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/orders.ordered') }}
</span>
@elseif($order->status == Order::DELIVERED)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orders.deliverd') }}
</span>
@elseif($order->status == Order::CANCELED)
<span class="font-weight-bold badge badge-pill badge-danger">
    {{ trans('Admin/orders.canceled') }}
</span>
@else
<span class="font-weight-bold badge badge-pill badge-warning">
    {{ trans('Admin/orders.no_status_of_this_order') }}
</span>
@endif