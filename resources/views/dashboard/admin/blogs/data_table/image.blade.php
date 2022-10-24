
@if($blog->image)
<a href="#">
    <img src="{{ asset('Dashboard/img/blogs/'. $blog->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="#">
    <img width="100%" src="{{ asset('Dashboard/img/blogs/default_blog.jpg') }}"
        data-src="{{ asset('Dashboard/img/blogs/default_blog.jpg') }}" alt="demo" />
</a>

@endif
