
   {{-- <h4>{{ $admin->type }} </h4> --}}
<h4>{{$admin->type =='admin' ?  __('Admin/site.admins') : __('Admin/site.employee')}}</h4>
