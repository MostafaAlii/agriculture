@if ($product->special_price > 0)
        <span class="font-weight-bold badge badge-pill badge-dark">
            {{ trans('Admin\products.product_main_price') }}
            {{ number_format($product->getPrice(), 2) }}
        </span>
        <br>
        <span class="font-weight-bold badge badge-pill badge-warning">
            {{ trans('Admin\products.product_private_price') }}
            {{ number_format($product->special_price, 2) }}
        </span>
        <br>
        <span class="font-weight-bold badge badge-pill badge-success">
            {{ trans('Admin\products.product_start_date_offer') }}
            {{ $product->special_price_start->format('Y-m-d') }}
        </span>
        <br>
        <span class="font-weight-bold badge badge-pill badge-danger">
            {{ trans('Admin\products.product_end_date_offer') }}
            {{ $product->special_price_end->format('Y-m-d') }}
        </span>
        @if(isset($remove_unit)&&$remove_unit==1)
        @else
            <br>
            <span class="font-weight-bold badge badge-pill badge-dark text-center">{{ $product->getUnit()->Name }}</span>
        @endif
    </div>
    @else
        <span class="font-weight-bold badge badge-pill badge-dark">
            {{ trans('Admin\products.product_main_price') }}
            {{ number_format($product->getPrice(), 2) }}
        </span>
        @if(isset($remove_unit)&&$remove_unit==1)
        @else
            <br>
            <span class="font-weight-bold badge badge-pill badge-dark">{{ $product->getUnit()->Name }}</span>
        @endif
    @endif
