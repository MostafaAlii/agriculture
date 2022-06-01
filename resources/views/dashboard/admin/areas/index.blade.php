@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')

    {{ trans('Admin/areas.areaPageTitle') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">flag</i>
                    {{ trans('Admin/areas.areaPageTitle') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Areas.index') }}">{{ trans('Admin/areas.areaPageTitle') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Breadcrumbs -->
        <!-- Start Content Body -->
        <div class="content-body">
            <!-- Start Zero configuration table -->
            <section id="configuration">
                <!-- Start row -->
                <div class="row">
                    <!-- Start col-12 -->
                    <div class="col-12">
                        <!-- Start Card -->
                        <div class="card">
                            <!-- Start Card Header -->
                            <div class="card-header">
                                <h4 class="card-title">{{ trans('Admin/areas.areaPageTitle') }}</h4>
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

                            <!-- End Card Header -->
                            <!-- Start Card Content -->
                            <div class="card-content collapse show">


                            <!-- Start Content Body -->
                                <div class="card-body card-dashboard">
                                    @can('area-create')
                                        <button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#add">
                                            <i class="material-icons">add_box</i>
                                            {{ trans('Admin/areas.add_new_area') }}
                                        </button>
                                   @endcan
                                   @can('area-delete-all')
                                        <button type="button" class="btn btn-warning btn-md mb-3"
                                            id="btn_delete_all" data-toggle="modal"
                                            data-target="#bulkdelete" >
                                            {{ __('Admin/site.bulkdelete') }}
                                        </button>
                                    @endcan
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <!-- Start Area Filter -->
                                        {{--@can('area-filter-operation')--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col col-md-6 m-2 p-2 pull-right">--}}
                                                    {{--<div class="form-group">--}}
                                                        {{--<label for="eventRegInput1">{{ __('Admin/areas.choose_columns') }}<span class="text-danger">*</span></label>--}}
                                                        {{--<select class="select form-control" multiple="multiple"--}}
                                                                {{--id="people" name="people[]">--}}
                                                            {{--<option value="0">id</option>--}}
                                                            {{--<option value="1">{{ __('Admin/areas.area_name') }}</option>--}}
                                                            {{--<option value="2">{{ __('Admin/areas.provience_name') }}</option>--}}
                                                            {{--<option value="3">{{ __('Admin/areas.state_name') }}</option>--}}
                                                            {{--<option value="4">{{ __('Admin/general.created_since') }}</option>--}}
                                                            {{--<option value="5">{{ __('Admin/site.action') }}</option>--}}
                                                        {{--</select>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--@endcan--}}
                                        <!-- End Area Filter -->
                                        <!-- Start Table -->
                                        <table class="table table-striped table-bordered zero-configuration" id="areas_table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/areas.area_name') }}</th>
                                                    <th>{{ __('Admin/areas.provience_name') }}</th>
                                                    <th>{{ __('Admin/areas.state_name') }}</th>
                                                    <th>{{ __('Admin/general.created_since') }}</th>
                                                    <th>{{ __('Admin/site.action') }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <!-- End Table -->
                                    </div>
                                    <!-- End Table Responsive -->
                                </div>
                                <!-- End Content Body -->
                            </div>
                            <!-- End Card Content -->
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End col-12 -->
                </div>
                <!-- End row -->
                 @include('dashboard.admin.areas.btn.add')
            </section>
            <!-- End Zero configuration table -->
        </div>
        <!-- End Content Body -->
    </div>
    <!-- End Content Wrapper -->
@endsection


@section('js')

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/multiple-select/1.2.3/multiple-select.min.js" integrity="sha512-VNtDkcpQUSFRARraRlhAnATQL9G3NbFefLfDBHJnXKYMZgAhBTMAEscjgPzAljCUQjLHx5Yk3JaIMaF1RvFYIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Datatable Fire -->
    <script src="{{ asset('assets/admin/js/jquery-3.4.0.js')}}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/dataTables.buttons.min.js')}}"></script>

    <script src="{{ asset('assets/admin/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/multiple-select.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/buttons.html5.min.js')}}"></script>

    <script type="text/javascript">

        function hideAllColumns(){
            for(var i=0;i<6;i++){
                columns = my_table.column(i).visible(0)
            }
        }
        function showAllColumns(){
            for(var i=0;i<6;i++){
                columns = my_table.column(i).visible(1)
            }
        }
        $(document).ready(function () {

            my_table = $('#areas_table').DataTable();

            $('#people').multipleSelect({

            onClick: function (view) {
                var selectedItem = $('#people').multipleSelect("getSelects");
                hideAllColumns();
                for(var i=0;i<selectedItem.length;i++){
                    var s = selectedItem[i];
                    my_table.column(s).visible(1);


                }
                $('#areas_table').css('width','100%');
                },
                onCheckAll:function () {
                    showAllColumns();
                    $('#areas_table').css('width','100%');
                },
                onUncheckAll:function () {
                    hideAllColumns();
                }

            })

        });
    </script>



<script>

    let areasTable = $('#areas_table').DataTable({
        serverSide: true,
        processing: true,

        dom: 'Bfrtip',
        order: [[0, 'desc']],

    buttons: [
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            pageSize: 'A4',
            exportOptions: {
                            columns: [ 1, 2, 3 ]
                        },
            // columns: ':visible',
            className: 'btn btn-primary ml-1',

        },
        'excel',
        {
            extend: 'print',
            exportOptions: {
                columns: [ 1, 2, 3 ]
            },
            // columns: ':visible',
            autoPrint: true,
            orientation: 'landscape',
            className: 'btn btn-success ml-1',
            pageSize: 'A4',
        },
'colvis',


    ],

        "language": {
                "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
        ajax: {
            url: '{{ route('areas.data') }}',
        },
        columns: [

            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'name', name: 'name', searchable: false, sortable: false},
            {data: 'province', name: 'province.name', searchable: false, sortable: false},
            {data: 'states', name: 'states.name', searchable: false, sortable: false},
            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
    });
    // function hideAllColumns(){
    //     for($i=0 ;i<4;i++){
    //         columns = areas-table.column(i).visible(0);
    //     }
    // }
    // // $(document).ready(function() {
    //     ('#people').multiselect({
    //         columns: 1,
    //         placeholder: 'Select Languages',
    //         search: true,
    //         selectAll: true,
    //         onClick: function (view) {
    //
    //         },
    //         onCheckAll: function () {
    //
    //         },
    //         onUncheckAll: function () {
    //             hideAllColumns();
    //         }
    //     })
    // });
</script>


    {{--<script type="text/javascript">--}}
        {{--$(function(){--}}
            {{--$('#people').multiselect({--}}
                {{--columns: 1,--}}
                {{--placeholder: 'Select Languages',--}}
                {{--search: true,--}}
                {{--selectAll: true,--}}
                {{--checkbox:true,--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}
@endsection
