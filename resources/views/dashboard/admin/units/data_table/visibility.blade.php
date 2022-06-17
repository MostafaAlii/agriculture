<span class="font-weight-bold badge badge-pill badge-{{ $unit->visibility == 1 ? 'success' : 'primary'  }}">
    {{ $unit->visibility == 1 ? __('Admin/units.for_product') : __('Admin/units.general') }}<br>
</span>
