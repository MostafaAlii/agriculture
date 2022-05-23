@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin\admin_departments.adminDepartmentPageTitle') }}
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
                                    <div>
                                        <h2>{{__('Admin\admin_departments.admin_departments')}}</h2>
                                        <hr/>
                                    </div>
                                    <div class="mb-1">
                                        @can('admin-department-edit')
                                            <a href="" class="btn btn-info edit-dep show-btn-control hidden">{{__('Admin\admin_departments.edit')}}</a>
                                        @endcan
                                        @can('admin-department-delete')
                                            <a href="" class="btn btn-danger delete-dep show-btn-control hidden" data-toggle="modal"
                                            data-target="#exampleModal">{{__('Admin\admin_departments.delete')}}</a>
                                        @endcan
                                    </div>

                                {{--modal start delete department--}}


                                <!-- start Modal delete-->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="" method="post" id="form_delete_department">
                                                    @csrf
                                                    @method('delete')
                                                    <div class="modal-body">
                                                        {{__('Admin\admin_departments.ask_delete')}} <span id="dept_name"></span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Admin\admin_departments.cancel')}}</button>
                                                        <button type="submit" class="btn btn-primary">{{__('Admin\admin_departments.delete')}}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                {{--modal end delete department--}}


                                    <div id="jstree"></div>
                                    <input name="parent" type="hidden" value="" class="parent_id">

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
                    'data' :   {!! load_dep() !!},
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
                    name.push(data.instance.get_node(data.selected[i]).text);

                }
                $('.parent_id').val(r.join(', '));

                $('#form_delete_department').attr('action','{{url(App::getLocale().'/dashboard_admin/AdminDepartments')}}/'+r.join(', '))
                        $('#dept_name').text('name',r.join(', '))

                if(r.join(', ')!=''){
                    $('.show-btn-control').removeClass('hidden');
                    $('.edit-dep').attr('href','{{url(App::getLocale().'/dashboard_admin/AdminDepartments')}}/'+r.join(', ')+'/edit')

                }else{
                    $('.show-btn-control').addClass('hidden');
                }

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
