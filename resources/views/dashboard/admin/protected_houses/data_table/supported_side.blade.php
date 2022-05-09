@if ($protected->supported_side == \App\Models\ProtectedHouse::SPATIAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/p_houses.private') }}
</span>
@elseif ($protected->supported_side == \App\Models\ProtectedHouse::GOVERMENTAL)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/p_houses.govermental') }}
</span>
@elseif ($protected->supported_side == \App\Models\ProtectedHouse::INTERNATIONAL_ORGANIZATION)
    <span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/p_houses.international_organizations') }}
</span>

@endif