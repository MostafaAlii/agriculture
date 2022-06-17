@if($product->image)
    <img src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" style="width: 100px; height: 100px;"
    alt="{{ __('Admin/site.no-image') }}" >
@else
    <img src="{{ asset('Dashboard/img/products/default.jpg') }}" style="width: 100px;" alt="{{ __('Admin/site.no-image') }} ">
@endif




