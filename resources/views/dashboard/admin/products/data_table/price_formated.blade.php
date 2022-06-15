@if($product->units->price)
<strong>{{ $product->units->price . ' '}} <span class="text-danger">{{  config('app.Currency') }}</span></strong>
@else
No Price Found
@endif
