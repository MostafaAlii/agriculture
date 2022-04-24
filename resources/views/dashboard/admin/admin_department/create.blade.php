@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/admin_departments.adminDepartmentPageTitle') }}
@endsection
@section('content')
    @include('dashboard\common\_partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\admin_departments.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{trans('Admin\admin_departments.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{ route('AdminDepartments.index') }}">{{trans('Admin\admin_departments.admin_departments')}}</a>
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
                                    id="basic-layout-form">{{trans('Admin\admin_departments.admin_departments')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">

                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                        <p></p>
                                    </div>
                                    <form class="form" action="{{route('AdminDepartments.store')}}" method="post"
                                          enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                        class="ft-settings"></i> {{trans('Admin\admin_departments.admin_departments')}}
                                            </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('Admin\admin_departments.dep_name_ar')}}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                               placeholder="{{trans('Admin\admin_departments.dep_name_ar')}}"
                                                               name="dep_name_ar" >
                                                        {{--<input type="hidden" id="projectinput1" class="form-control"  name="id" >--}}
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('Admin\admin_departments.dep_name_en')}}</label>
                                                        <input type="text" id="projectinput1" class="form-control"
                                                               placeholder="{{trans('Admin\admin_departments.dep_name_en')}}"
                                                               name="dep_name_en" >
                                                        {{--<input type="hidden" id="projectinput1" class="form-control"  name="id" >--}}
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <div class="clearfix"></div>
                                                    <label for="companyName">{{trans('Admin\admin_departments.departments')}}</label>
                                                    <div id="jstree"></div>
                                                    <input name="parent" type="hidden" value="{{old('parent')}}" class="parent_id">
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>

                                            <div class="row">
                                            <div class="col col-md-6">
                                                <div class="form-group">
                                                    <label for="companyName">{{trans('Admin\admin_departments.keys')}}</label>
                                                    <textarea type="text" id="companyName" class="form-control"
                                                              placeholder="{{trans('Admin\admin_departments.keys')}}"
                                                              name="keys">
                                                        </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="companyName">{{trans('Admin\admin_departments.desc')}}</label>
                                                    <textarea id="companyName" class="form-control" type="text"
                                                              name="desc"
                                                              placeholder="{{trans('Admin\admin_departments.desc')}}">
                                                        </textarea>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1">
                                                    <i class="ft-x"></i> {{trans('Admin\admin_departments.cancel')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('Admin\admin_departments.save')}}
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
    {{--<script src="{{ asset('assets/admin/js/jquery-1.12.1.min.js')}}"></script>--}}
    {{--<script src="{{asset('assets/admin/jstree/jstree.js')}}" type="text/javascript"></script>--}}

    <script  type="text/javascript">

        $(document).ready(function () {

            $('#jstree').jstree({
                "core" : {
                    'data' :
                    {!! load_dep(old('parent')) !!}
                    ,
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
                var i, j, r = [];
                for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                }
                $('.parent_id').val(r.join(', '));

            });

    </script>


    <script type="text/javascript">

        var loadFile = function (event) {
            var img = document.getElementById('output');
            img.src = URL.createObjectURL(event.target.files[0]);
            output.img = function () {
                URL.revokeObjectURL(img.src)
            }

        };
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"
            integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
