
@if($farmer->image)
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ asset('Dashboard/img/farmers/'. $farmer->image->filename) }}" style="width: 100px;" alt="">
</a>

@else
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ asset('Dashboard/img/farmers/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
