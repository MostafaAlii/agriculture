{{-- <h4>{{ $admin->type }} </h4> --}}
{{--<h4>{{$admin->type =='admin' ?  __('Admin/site.admins') : __('Admin/site.employee')}}</h4>--}}
@if($admin->type =='admin')
    <h4>{{__('Admin/site.admins')}}</h4>
@elseif($admin->type =='admin_area')
    <h4>{{__('Admin/site.admin_area')}}</h4>
@else
    <h4>{{__('Admin/site.employee')}}</h4>
@endif