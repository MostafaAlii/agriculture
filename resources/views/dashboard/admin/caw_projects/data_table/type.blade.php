@if ($cawProject->type == \App\Models\CawProject::SHIP)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/animals.ship') }}
</span>
@elseif($cawProject->type == \App\Models\CawProject::CAW)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/animals.caw') }}
</span>
@elseif($cawProject->type == \App\Models\CawProject::FISH)

<span class="font-weight-bold badge badge-pill badge-danger">
    {{ trans('Admin/animals.fish') }}
</span>

@endif