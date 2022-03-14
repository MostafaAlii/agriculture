
@if($admin->image)
<img src="{{ asset('Dashboard/img/admins/'. $admin->image->filename) }}" style="width: 100px; height: 100px;" alt="">

@else
<img src="{{ asset('Dashboard/img/images/avatar.jpg') }}" style="width: 100px;" alt="">

@endif
