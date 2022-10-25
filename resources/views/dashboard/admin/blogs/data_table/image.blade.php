@if($blog->image_path)
<a href="#">
    <img src="{{  $blog->image_path }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="#">
    <img width="100%" src="{{ asset('Dashboard/img/Default/default_blog.jpg') }}"
        data-src="{{ asset('Dashboard/img/Default/default_blog.jpg') }}" alt="demo" />
</a>
@endif
