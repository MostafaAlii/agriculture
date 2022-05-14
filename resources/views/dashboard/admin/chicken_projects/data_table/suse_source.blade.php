@if ($chickenProject->suse_source == \App\Models\ChickenProject::LOCAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/animals.local') }}
</span>
@elseif($chickenProject->suse_source == \App\Models\ChickenProject::IMPORTED)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/animals.imported') }}
</span>

@endif