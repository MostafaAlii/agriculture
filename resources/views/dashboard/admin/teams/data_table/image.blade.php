
@if($team->image)
 <img src="{{ asset('Dashboard/img/team/'. $team->image) }}" style="width: 100px;" alt="">
@else
<img src="{{ asset('Dashboard/img/Default/default_team.jpg') }}" style="width: 100px;" alt="">
@endif
