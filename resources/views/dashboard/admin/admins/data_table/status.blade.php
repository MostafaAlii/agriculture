<span class="font-weight-bold badge badge-pill badge-{{ $admin->status == 1 ? 'success' : 'danger'  }}">
    {{ $admin->status == 1 ? __('Admin/products.active') : __('Admin/products.unactive') }}<br>

</span>
<br><i class='fa fa-exchange'></i>
<!-- {{__('Admin/products.change')}} -->
<a href="{{route('change_status',encrypt($admin->id))}}" title="للتحويل الى  {{ ($admin->status == 1) ? trans('Admin/products.unactive') : trans('Admin/products.active') }} ">
    {{ $admin->status == 1 ? __('Admin/products.unactive') : __('Admin/products.active') }}
</a>
