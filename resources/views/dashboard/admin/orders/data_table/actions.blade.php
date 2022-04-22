<div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Admin/site.action') }}
        </button>
        <div class="dropdown-menu dropmenu-menu-right">
            <a href="{{ route('order.show', encrypt($id)) }}" class="dropdown-item btn btn-outline-primary btn-md">
                {{ __('Admin/orders.show') }}
            </a>
            <a href="{{ route('order.print', encrypt($id)) }}" target="_blank" class="dropdown-item btn btn-outline-success btn-md">
                {{ __('Admin/orders.print_order_invoice') }}
            </a>
            <div class="dropdown-divider"></div>
        </div>
</div>
<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Admin/orders.order_status') }}
    </button>
    <div class="dropdown-menu dropmenu-menu-left">
        <a href="#" class="dropdown-item btn btn-outline-secondary btn-md">
            {{ __('Admin/orders.order_delivered') }}
        </a>
        <a href="#" class="dropdown-item btn btn-outline-danger btn-md">
            {{ __('Admin/orders.order_canceled') }}
        </a>
        <div class="dropdown-divider"></div>
    </div>
</div>