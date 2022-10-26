@if($user->image_path)
<a href="{{ route('user.profile', encrypt($user->id)) }}">
    <img src="{{ $user->image_path }}" style="width: 100px; height: 100px;"
        alt="{{ $user->firstname . ' ' . $user->lastname }}">
</a>

@else
<a href="{{ route('user.profile', encrypt($user->id)) }}">
    <img src="{{ asset('Dashboard/img/Default/default_vendor.jpg') }}" style="width: 100px;"
        alt="{{ $user->firstname . ' ' . $user->lastname }}">
</a>
@endif