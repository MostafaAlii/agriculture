
@if($worker->image->filename)
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ asset('Dashboard/img/workers/'. $worker->image->filename) }}" style="width: 100px; height: 100px;" alt="">
</a>

@else
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ asset('Dashboard/img/workers/avatar.jpg') }}" style="width: 100px;" alt="">
</a>

@endif
