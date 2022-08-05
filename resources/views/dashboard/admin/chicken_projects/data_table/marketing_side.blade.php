@if ($chickenProject->marketing_side == \App\Models\ChickenProject::SPATIAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/animals.private') }}
</span>
@elseif($chickenProject->marketing_side == \App\Models\ChickenProject::GOVERMENTAL)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/animals.govermental') }}
</span>


@endif