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
                            @if(Auth::guard('admin')->user()->image)
                                <a class="mr-2" href="#">
                                        <img src="{{ asset('Dashboard/img/admins/'. Auth::guard('admin')->user()->image->filename) }}"
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
                                    <span class="users-view-name">{{ Auth::guard('admin')->user()->firstname }} {{ Auth::guard('admin')->user()->lastname }}</span>
                                </h4>
                                <span class="users-view-id">{{ Auth::guard('admin')->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                        <a href="{{ route('profile.edit',encrypt(Auth::guard('admin')->user()->id)) }}" class="btn btn-sm btn-primary"> @lang('Admin/site.edit')</a>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm mr-25 border"> @lang('Admin/site.back')</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>@lang('Admin/site.name'):</td>
                                            <td class="users-view-username">{{ Auth::guard('admin')->user()->firstname }} {{ Auth::guard('admin')->user()->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.email'):</td>
                                            <td class="users-view-email">{{ Auth::guard('admin')->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.phonenum'):</td>
                                            <td>{{ Auth::guard('admin')->user()->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.type'):</td>
                                            <td>{{ Auth::guard('admin')->user()->type =='admin'?__('Admin/site.admins') : __('Admin/site.employee')}}</td>
                                        </tr>

                                    </tbody>
                                </table>

                                <h5 class="mb-1"><i class="ft-info"></i> @lang('Admin/site.personalinfo')</h5>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>@lang('Admin/site.birthday'):</td>
                                            <td>{{ Auth::guard('admin')->user()->birthdate }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.country'):</td>
                                            <td>{{ Auth::guard('admin')->user()->country->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.province'):</td>
                                            <td>{{ Auth::guard('admin')->user()->province->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.area'):</td>
                                            <td>{{ Auth::guard('admin')->user()->area->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.state'):</td>
                                            <td>{{ Auth::guard('admin')->user()->state->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.village'):</td>
                                            <td>{{ Auth::guard('admin')->user()->village->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.department'):</td>
                                            <td>{{ Auth::guard('admin')->user()->department->name ?? null}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.address1'):</td>
                                            <td>{{ Auth::guard('admin')->user()->address1 }}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Admin/site.address2'):</td>
                                            <td>{{ Auth::guard('admin')->user()->address2 }}</td>
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
