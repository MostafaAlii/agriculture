
@if($blog->image)
<a href="#">
    <img src="{{ asset('Dashboard/img/blogs/'. $blog->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="#">
    <img src="{{ asset('Dashboard/img/images/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
