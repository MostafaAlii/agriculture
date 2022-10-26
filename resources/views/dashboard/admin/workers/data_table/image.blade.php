@if($worker->image_path)
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ $worker->image_path }}" style="width: 100px; height: 100px;"
        alt="{{ $worker->firstname . ' ' . $worker->lastname }}">
</a>

@else
<a href="{{ route('worker.profile', encrypt($worker->id)) }}">
    <img src="{{ asset('Dashboard/img/Default/default_worker.jpg') }}" style="width: 100px;"
        alt="{{ $worker->firstname . ' ' . $worker->lastname }}">
</a>

@endif
