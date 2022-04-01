<span class="font-weight-bold badge badge-pill badge-{{ $product->status == 1 ? 'success' : 'danger'  }}">
    {{ $product->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}
</span>