@if($product->getPrice())
<strong>
    {{ $product->getPrice() }}
    <span class="text-danger">{{  config('app.Currency') }}</span>
</strong>
@endif
