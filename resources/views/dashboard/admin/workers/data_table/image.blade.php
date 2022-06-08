
@if($worker->image)
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ asset('Dashboard/img/workers/'. $worker->image->filename) }}" style="width: 100px; height: 100px;" alt="{{ __('Admin/site.no-image') }}>
</a>

@else
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ asset('Dashboard/img/profile.png') }}" style="width: 100px;" alt="{{ __('Admin/site.no-image') }}>
</a>

@endif
