
@if($user->image)
<a href="{{ route('user.profile', encrypt($user->id)) }}">
    <img src="{{ asset('Dashboard/img/users/'. $user->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="{{ route('user.profile', encrypt($user->id)) }}">
    <img src="{{ asset('Dashboard/img/images/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
