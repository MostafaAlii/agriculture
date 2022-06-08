
@if($admin->image)
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ asset('Dashboard/img/admins/'. $admin->image->filename) }}" style="width: 100px; height: 100px;" alt="{{ __('Admin/site.no-image') }}>
</a>

@else
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ asset('Dashboard/img/profile.png') }}" style="width: 100px;" alt="{{ __('Admin/site.no-image') }}>
</a>

@endif
