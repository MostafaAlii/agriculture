
@if($farmer->image)
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ asset('Dashboard/img/farmers/'. $farmer->image->filename) }}" style="width: 100px;" alt="{{ __('Admin/site.no-image') }}">
</a>

@else
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ asset('Dashboard/img/profile.png') }}" style="width: 100px;" alt="{{ __('Admin/site.no-image') }}">
</a>

@endif
