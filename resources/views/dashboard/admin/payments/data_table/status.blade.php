<span class="font-weight-bold badge badge-pill badge-{{ $payment->status == 1 ? 'success' : 'danger'  }}">
    {{ $payment->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}
</span>