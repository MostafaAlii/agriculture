@if ($income->country_product_type == \App\Models\IncomeProduct::LOCAL)
<span class="font-weight-bold badge badge-pill badge-primary">
    {{ trans('Admin/income_products.local') }}
</span>
@elseif($income->country_product_type == \App\Models\IncomeProduct::IRAQ)
<span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/income_products.iraq') }}
</span>
@elseif($income->country_product_type == \App\Models\IncomeProduct::IMPORTED)
    <span class="font-weight-bold badge badge-pill badge-success">
    {{ trans('Admin/income_products.imported') }}
</span>

@endif