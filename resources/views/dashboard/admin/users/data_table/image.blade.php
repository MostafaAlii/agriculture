
@if($user->image)
<img src="{{ asset('Dashboard/img/users/'. $user->image->filename) }}" style="width: 100px; height: 100px;" alt="">

@else
<img src="{{ asset('assets/admin/images/avatar.jpg') }}" style="width: 100px;" alt="">

@endif
