@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
     @lang('Admin/site.profile')
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users view start -->
            <section class="users-view">
                <!-- users view media object start -->
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">
                            @if($worker->image)
                                <a class="mr-2" href="#">
                                        <img src="{{ asset('Dashboard/img/workers/'. $worker->image->filename) }}"
                                        alt="{{ __('Admin/site.no-image') }}"
                                        class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                                </a>
                            @else
                                <a class="mr-2" href="#">
                                    <img src="{{ asset('Dashboard/img/profile.png') }}"
                                    alt="{{ __('Admin/site.no-image') }}"
                                    class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                                </a>
                            @endif
                            <div class="media-body pt-25">
                                <h4 class="media-heading">
                                <span class="users-view-name">{{ $worker->firstname }} {{ $worker->lastname }}</span>
                                <span class="users-view-id">{{ $worker->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        @can('worker-edit')
                        <a href="{{ route('workers.edit',encrypt($worker->id)) }}" class="btn btn-sm btn-primary"> @lang('Admin/site.edit')</a>
                        @endcan
                        <a href="{{ route('workers.index') }}" class="btn btn-sm mr-25 border"> @lang('Admin/site.back')</a>
                    </div>
                </div>

                <div class="col-12">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>@lang('Admin/site.name'):</td>
                                <td class="users-view-username">{{ $worker->firstname }} {{ $worker->lastname }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.email'):</td>
                                <td class="users-view-email">{{ $worker->email }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.phonenum'):</td>
                                <td>{{ $worker->phone }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.status'):</td>
                                <td>{{$worker->status == 1 ?  __('Admin/site.active') : __('Admin/site.unactive')}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.worktype'):</td>
                                <td>{{$worker->work == 'alone' ?  __('Admin/site.alone') : __('Admin/site.team')}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.salarytype'):</td>
                                <td> {{$worker->salary == 'perday' ?  __('Admin/site.perday') : __('Admin/site.perhour')}}</td>
                            </tr>
                            @if($worker->daily_price != null)
                                <tr>
                                    <td>@lang('Admin/site.daily'):</td>
                                    <td> $ {{number_format($worker->daily_price,2) }} </td>
                                </tr>
                            @else
                                <tr>
                                    <td>@lang('Admin/site.hourly'):</td>
                                    <td> $ {{number_format($worker->hourly_price,2) }} </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <h5 class="mb-1"><i class="ft-info"></i> @lang('Admin/site.personalinfo')</h5>
                    <table class="table table-borderless mb-0">
                        <tbody>
                            <tr>
                                <td>@lang('Admin/site.birthday'):</td>
                                <td>{{ $worker->birthdate }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.country'):</td>
                                <td>{{ $worker->country->name ?? null }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.province'):</td>
                                <td>{{ $worker->province->name?? null }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.area'):</td>
                                <td>{{ $worker->area->name ?? null}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.state'):</td>
                                <td>{{ $worker->state->name ?? null}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.village'):</td>
                                <td>{{ $worker->village->name?? null }}</td>
                            </tr>

                            <tr>
                                <td>@lang('Admin/site.address1'):</td>
                                <td>{{ $worker->address1 }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.address2'):</td>
                                <td>{{ $worker->address2 }}</td>
                            </tr>
                            <tr>
                                <td>@lang('Admin/site.desc'):</td>
                                <td>{!! $worker->desc !!}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- users view card details ends -->

</section>
        <!-- users view ends -->
    </div>
</div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@endsection
