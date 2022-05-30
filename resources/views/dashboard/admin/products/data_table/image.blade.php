
@if($product->image->filename)
 <img src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" style="width: 100px;" alt="">
@else
<img src="{{ asset('Dashboard/img/images/products/default.jpg') }}" style="width: 100px;" alt="">
@endif
