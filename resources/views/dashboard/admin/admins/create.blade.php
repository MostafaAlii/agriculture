@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/setting.settingPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\setting.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Admins.index') }}">{{ __('Admin/site.admins') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.add') }}
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
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.newadmin') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" method="post" action="{{ route('Admins.store') }}" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/site.firstname') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/site.firstname') }}" name="firstname" value="{{ old('firstname') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/site.lastname') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/site.lastname') }}" name="lastname" value="{{ old('lastname') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/site.email') }}<span class="text-danger">*</span></label>
                                                        <input type="email" id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/site.email') }}" name="email" value="{{ old('email') }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput5">{{ __('Admin/site.phone') }}<span class="text-danger">*</span></label>
                                                        <input type="tel" id="eventRegInput5" class="form-control" name="phone" placeholder="{{ __('Admin/site.phone') }}" value="{{ old('phone') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{--password--}}
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.password') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                                                    </div>
                                                    {{--password_confirmation--}}
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.password_confirmation') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="">{{__('Admin\admins.admin_department')}}</label>
                                                    <hr>
                                                    <div id="jstree"></div>
                                                    <input name="admin_department_id" type="hidden" value="" class="admin_department_id">

                                                </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label for="area_id">{{ __('Admin/orchards.area') }}</label>
                                                        <select name="area_id" id="area_id" class="form-control" required>
                                                            <option value="">{{ __('Admin/site.select') }}</option>
                                                            </option>
                                                            @foreach ($areas as $area)
                                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col col-md-4">

                                                    <div class="form-group">
                                                        <label for="state_id">{{ __('Admin/orchards.state') }}</label>
                                                        <select class=" form-control" name="state_id" id="state_id">
                                                            <option value="">{{ __('Admin/site.select') }}</option>

                                                        </select>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-4">
                                                    <fieldset class="form-group">
                                                        <label>{{ __('Admin/site.user-type') }}<span class="text-danger">*</span></label>

                                                        <select class="custom-select" id="customSelect" name="type">
                                                            <option selected>{{ __('Admin/site.select') }}</option>
                                                            <option value="admin">{{ __('Admin/site.admins') }}</option>
                                                            <option value="employee">{{ __('Admin/site.employee') }}</option>
                                                        </select>
                                                    </fieldset>
                                                 </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.image') }} :  <span style="color:rgb(199, 8, 8)">*</span></label>
                                                        <input class="form-control img" name="image"  type="file" accept="image/*" required >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <img src="{{ asset('assets/admin/images/avatar.jpg') }}" class="img-thumbnail img-preview" width="100" alt="">
                                                </div>
                                            </div>

                                            <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
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

    <script>
        $(document).ready(function() {
            //  ajax for get states data of area =====================================================================
            $('select[name="area_id"]').on('change', function() {
                var area_id = $(this).val();
                // console.log(province_id);
                if (area_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/state') }}/" + area_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="state_id"]').empty();
                            $('select[name="state_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="state_id"]').append(
                                    '<option value="' + key + '">' + value +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script  type="text/javascript">

        $(document).ready(function () {

            $('#jstree').jstree({
                "core" : {
                    'data' :   {!! load_dep(old('admin_department_id')) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow",  ]
            });
        });


        $('#jstree')
        // listen for event
            .on('changed.jstree', function (e, data) {
                var i, j,r = [];
                var name=[];
                for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);

                }
                $('.admin_department_id').val(r.join(', '));



            });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

