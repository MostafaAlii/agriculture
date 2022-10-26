@if($farmer->image_path)
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ $farmer->image_path }}" style="width: 100px; height: 100px;"
        alt="{{ $farmer->firstname . ' ' . $farmer->lastname }}">
</a>

@else
<a href="{{ route('farmer.profile', encrypt($farmer->id)) }}">
    <img src="{{ asset('Dashboard/img/Default/default_farmer.jpg') }}" style="width: 100px;"
        alt="{{ $farmer->firstname . ' ' . $farmer->lastname }}">
</a>

@endif