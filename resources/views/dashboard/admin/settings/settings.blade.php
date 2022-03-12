@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/setting.settingPageTitle') }}
@endsection
@section('content')
    @include('dashboard\common\_partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\setting.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{trans('Admin\setting.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('settings') }}">{{trans('Admin\setting.settings')}}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"
                                    id="basic-layout-form">{{trans('Admin\setting.setting_info')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">

                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                        <p></p>
                                    </div>
                                    <form class="form" action="{{route('settings')}}" method="get"
                                          enctype="multipart/form-data" autocomplete="off">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                        class="ft-settings"></i> {{trans('Admin\setting.setting_info')}}
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('Admin\setting.site_name')}}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                               placeholder="{{trans('Admin\setting.site_name')}}"
                                                               name="site_name"
                                                               value="{{$setting_t->site_name}}" >
                                                        <input type="hidden" id="projectinput1" class="form-control"

                                                               name="id"
                                                               value="{{$setting->id}}"
                                                        >
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput2">{{trans('Admin\setting.supporting_mail')}}</label>
                                                        <input type="text" id="projectinput2" class="form-control"
                                                               placeholder="{{trans('Admin\setting.supporting_mail')}}"
                                                               name="support_mail"
                                                               value="{{$setting->support_mail}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput3">{{trans('Admin\setting.primary_phone')}}</label>
                                                        <input type="text" id="projectinput3" class="form-control"
                                                               placeholder="{{trans('Admin\setting.primary_phone')}}"
                                                               name="primary_phone"value="{{$setting->primary_phone}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput4">{{trans('Admin\setting.secondery_phone')}}</label>
                                                        <input type="text" id="projectinput4" class="form-control"
                                                               placeholder="{{trans('Admin\setting.secondery_phone')}}"
                                                               name="secondery_phone"value="{{$setting->secondery_phone}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput4"> {{trans('Admin\setting.facebook')}}</label>
                                                        <input type="text" id="projectinput4" class="form-control"
                                                               placeholder="{{trans('Admin\setting.facebook')}}"
                                                               name="facebook"value="{{$setting->facebook}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput4"> {{trans('Admin\setting.inestergrame')}}</label>
                                                        <input type="text" id="projectinput4" class="form-control"
                                                               placeholder="{{trans('Admin\setting.inestergrame')}}"
                                                               name="inestegram"value="{{$setting->inestegram}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput4">{{trans('Admin\setting.twitter')}} </label>
                                                        <input type="text" id="projectinput4" class="form-control"
                                                               placeholder="{{trans('Admin\setting.twitter')}}"
                                                               name="twitter"value="{{$setting->twitter}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col col-md-6">
                                                    <div class="form-group">
                                                        <label for="companyName">{{trans('Admin\setting.address')}}</label>
                                                        <input type="text" id="companyName" class="form-control"
                                                               placeholder="{{trans('Admin\setting.address')}}"
                                                               name="address"value="{{$setting_t->address}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput8">{{trans('Admin\setting.message_maintenance')}}</label>
                                                        <textarea id="projectinput8" rows="5" class="form-control"
                                                                  name="message_maintenance" value="{{$setting_t->message_maintenance}}"
                                                                  placeholder="{{trans('Admin\setting.message_maintenance')}}"></textarea>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">

                                                        <label>{{trans('Admin\setting.site_icon')}}</label>
                                                        <label id="projectinput7" class="file center-block">
                                                            {{--<input type="file" accept="image/*" name="site_icon" --}}
                                                            {{--onchange="loadFile1(event)">--}}
                                                            <input type="file" accept="image/*" name="site_icon">
                                                            <img src="{{Storage::url(setting()->site_icon)}}"
                                                                 height="50 px" width="50 px" id="output1">
                                                            @if(!empty(setting()->site_icon))

                                                                <img src="{{Storage::url(setting()->site_icon)}}"
                                                                     height="50 px" width="50 px" id="output1">
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('Admin\setting.site_logo')}} </label>
                                                        <label id="projectinput7" class="file center-block">
                                                            <input type="file" accept="image/*" name="site_logo">
                                                            {{--<input type="file" accept="image/*" name="site_logo"--}}
                                                            {{--onchange="loadFile(event)">--}}
                                                            <img src="{{Storage::url(setting()->site_logo)}}"
                                                                 height="50 px" width="50 px" id="output1">
                                                            @if(!empty(setting()->site_logo))

                                                                {{--<img src="{{Storage::url(setting()->site_logo)}}"--}}
                                                                     {{--height="50 px" width="50 px" id="output1">--}}
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> {{trans('Admin\setting.cancel')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('Admin\setting.save')}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->

@endsection
@section('js')
    <script type="text/javascript">

        var loadFile = function (event) {
            var img = document.getElementById('output');
            img.src = URL.createObjectURL(event.target.files[0]);
            output.img = function () {
                URL.revokeObjectURL(img.src)
            }

        };
    </script>

    <script type="text/javascript">

        var loadFile1 = function (event) {
            var output = document.getElementById('output1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }

        };
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
