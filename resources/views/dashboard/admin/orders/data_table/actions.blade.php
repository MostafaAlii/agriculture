<div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Admin/site.action') }}
        </button>
        <div class="dropdown-menu dropmenu-menu-right">
            <a href="{{ route('order.show', encrypt($id)) }}" class="dropdown-item btn btn-outline-primary btn-md">
                {{ __('Admin/orders.show') }}
            </a>
            <div class="dropdown-divider"></div>
        </div>
    </div>