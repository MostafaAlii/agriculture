
@if($admin->image->filename)
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ asset('Dashboard/img/admins/'. $admin->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ asset('Dashboard/img/admins/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
