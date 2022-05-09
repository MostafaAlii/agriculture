@if ($protected->status == \App\Models\ProtectedHouse::ACTIVE)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/p_houses.active') }}
</span>
@elseif($protected->status == \App\Models\ProtectedHouse::INACTIVE)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/p_houses.inactive') }}
</span>


@endif