@if ($beekeeper->supported_side == \App\Models\BeeKeeper::SPATIAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/orchards.private') }}
</span>
@elseif ($beekeeper->supported_side == \App\Models\BeeKeeper::GOVERMENTAL)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orchards.govermental') }}
</span>
@elseif ($beekeeper->supported_side == \App\Models\BeeKeeper::INTERNATIONAL_ORGANIZATION)
    <span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/orchards.international_organizations') }}
</span>

@endif