
@if($team->image)
 <img src="{{ asset('Dashboard/img/team/'. $team->image) }}" style="width: 100px;" alt="">
@else
<img src="{{ asset('Dashboard/img/images/team/default.jpg') }}" style="width: 100px;" alt="">
@endif
