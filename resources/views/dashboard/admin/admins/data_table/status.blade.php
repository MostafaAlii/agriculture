<span class="font-weight-bold badge badge-pill badge-{{ $admin->status == 1 ? 'success' : 'danger'  }}">
    {{ $admin->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}
</span>