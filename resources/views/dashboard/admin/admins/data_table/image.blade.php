@if($admin->image_path)
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ $admin->image_path }}" style="width: 100px; height: 100px;"
        alt="{{ $admin->firstname . ' ' . $admin->lastname }}">
</a>

@else
<a href="{{ route('admin.profile', encrypt($admin->id)) }}">
    <img src="{{ asset('Dashboard/img/Default/default_admin.jpg') }}" style="width: 100px;" alt="{{ $admin->firstname . ' ' . $admin->lastname }}">
</a>

@endif