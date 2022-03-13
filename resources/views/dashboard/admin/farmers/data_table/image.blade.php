
@if($farmer->image)
<img src="{{ asset('Dashboard/img/farmers/'. $farmer->image->filename) }}" style="width: 100px;" alt="">

@else
<img src="{{ asset('assets/admin/images/avatar.jpg') }}" style="width: 100px;" alt="">

@endif
