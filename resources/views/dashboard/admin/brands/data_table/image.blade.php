
@if($brand->image)
<a href="#">
    <img src="{{ asset('Dashboard/img/brands/'. $brand->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="#">
    <img src="{{ asset('Dashboard/img/images/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
