<span class="font-weight-bold badge badge-pill badge-{{ $admin->status == 1 ? 'success' : 'danger'  }}">
    {{ $admin->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}<br>

</span>
<a href="{{route('change_status',encrypt($admin->id))}}">
    {{ $admin->status == 1 ? __('Admin/products.unactive') : __('Admin/products.active') }}
</a>
