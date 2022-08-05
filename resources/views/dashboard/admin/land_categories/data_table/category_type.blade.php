@if ($land_category->category_type == \App\Models\LandCategory::AGRICULTURE)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/lands.agricultural') }}
</span>
@elseif ($land_category->category_type == \App\Models\LandCategory::NON_AGRICULTURE)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/lands.non_agricultural') }}
</span>


@endif