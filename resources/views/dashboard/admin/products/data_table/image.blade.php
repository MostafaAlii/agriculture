@if($product->image_path)
<a href="#">
    <img src="{{  $product->image_path }}" style="width: 100px; height: 100px;" alt="{{ $product->name }}">
</a>

@else
<a href="#">
    <img width="100%" src="{{ asset('Dashboard/img/Default/default_product.jpg') }}"
        data-src="{{ asset('Dashboard/img/Default/default_product.jpg') }}" alt="{{  $product->name }}" />
</a>
@endif