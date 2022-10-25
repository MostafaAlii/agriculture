@if($brand->image_path)
<a href="#">
    <img src="{{  $brand->image_path }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="#">
    <img width="100%" src="{{ asset('Dashboard/img/brands/default_brand.jpg') }}"
        data-src="{{ asset('Dashboard/img/brands/default_brand.jpg') }}" alt="demo" />
</a>

@endif