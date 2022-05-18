@if ($outcome->country_product_type == \App\Models\OutcomeProduct::LOCAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/income_products.local') }}
</span>
@elseif($outcome->country_product_type == \App\Models\OutcomeProduct::IRAQ)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/income_products.iraq') }}
</span>
@elseif($outcome->country_product_type == \App\Models\OutcomeProduct::IMPORTED)
    <span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/income_products.imported') }}
</span>

@endif