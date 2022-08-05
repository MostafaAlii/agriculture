@if ($cawProject->food_source == \App\Models\CawProject::LOCAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/animals.local') }}
</span>
@elseif($cawProject->food_source == \App\Models\CawProject::OUTER)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/animals.outer') }}
</span>


@endif