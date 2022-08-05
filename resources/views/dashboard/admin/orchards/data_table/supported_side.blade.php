@if ($chard->supported_side == \App\Models\Orchard::SPATIAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/orchards.private') }}
</span>
@elseif ($chard->supported_side == \App\Models\Orchard::GOVERMENTAL)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orchards.govermental') }}
</span>
@elseif ($chard->supported_side == \App\Models\Orchard::INTERNATIONAL_ORGANIZATION)
    <span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orchards.international_organizations') }}
</span>

@endif