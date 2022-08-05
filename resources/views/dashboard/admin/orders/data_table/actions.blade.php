@can('order-processes')
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Admin/site.action') }}
        </button>
        <div class="dropdown-menu dropmenu-menu-right">
            @can('order-show')
                <a href="{{ route('order.show', encrypt($id)) }}" class="dropdown-item btn btn-outline-primary btn-md">
                    {{ __('Admin/orders.show') }}
                </a>
            @endcan
            @can('order-invoice-print')
                <a href="{{ route('order.print', encrypt($id)) }}" target="_blank" class="dropdown-item btn btn-outline-success btn-md">
                    {{ __('Admin/orders.print_order_invoice') }}
                </a>
            @endcan
            <div class="dropdown-divider"></div>
        </div>
    </div>
@endcan