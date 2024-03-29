@if ($order->status == Order::ORDERED)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/orders.ordered') }}
</span>
@elseif($order->status == Order::DELIVERED)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orders.deliverd_process') }}
</span>
@elseif($order->status == Order::UNDER_PROCESS)
<span class="font-weight-bold badge badge-pill badge-default">
    {{ trans('Admin/orders.under_process') }}
</span>
@elseif($order->status == Order::FINISHED)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orders.finish') }}
</span>
@elseif($order->status == Order::REJECTED)
<span class="font-weight-bold badge badge-pill badge-warning">
    {{ trans('Admin/orders.order_reject') }}
</span>
@elseif($order->status == Order::PUSH_FROM_STOCK)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orders.push_from_stock') }}
</span>
@elseif($order->status == Order::CANCELED)
<span class="font-weight-bold badge badge-pill badge-danger">
    {{ trans('Admin/orders.canceled') }}
</span>
@else
<span class="font-weight-bold badge badge-pill badge-dark">
    {{ trans('Admin/orders.no_status_of_this_order') }}
</span>
@endif
