@if ($cawProject->marketing_side == \App\Models\CawProject::SPATIAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/animals.private') }}
</span>
@elseif($cawProject->marketing_side == \App\Models\CawProject::GOVERMENTAL)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/animals.govermental') }}
</span>


@endif