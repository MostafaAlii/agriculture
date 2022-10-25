



@if($slider->image_path)
<a href="#">
    <img src="{{  $slider->image_path }}" style="width: 100px; height: 100px;" alt="{{ $slider->title }}">
</a>

@else
<a href="#">
    <img width="100%" src="{{ asset('Dashboard/img/Default/default_slider.jpg') }}"
        data-src="{{ asset('Dashboard/img/Default/default_slider.jpg') }}" alt="demo" />
</a>
@endif