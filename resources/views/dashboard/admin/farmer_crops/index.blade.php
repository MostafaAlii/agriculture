@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/crops.farmerCropsPageTitle') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/orchards.orchards') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin/crops.farmerCropsPageTitle') }}</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Admin/crops.farmerCropsPageTitle') }}</h4>
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
                                <div class="card-body card-dashboard">
                                    <a href="{{ route('FarmerCrops.create') }}" class="btn btn-primary btn-sm mb-3"><i class="material-icons">add_box</i> {{ __('Admin/site.create') }}</a>
                                    <button type="button" class="btn btn-warning mb-3"
                                        id="btn_delete_all" data-toggle="modal"
                                        data-target="#bulkdelete" >
                                        <i class="fa fa-trash"></i>
                                        {{ __('Admin/site.bulkdelete') }}
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="farmer-crop-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/crops.farmer') }}</th>
                                                    <th>{{ __('Admin/crops.admin') }}</th>
                                                    <th>{{ __('Admin/crops.village') }}</th>

                                                    <th>{{ __('Admin/crops.winter_crops') }}</th>
                                                    <th>{{ __('Admin/crops.summer_crops') }}</th>

                                                    <th>{{ __('Admin/crops.winter_area_crop') }}</th>
                                                    <th>{{ __('Admin/crops.summer_area_crop') }}</th>
                                                    <th>{{ __('Admin/crops.date') }}</th>

                                                    <th>{{ __('Admin/site.created_at') }}</th>

                                                    <th>{{ __('Admin/site.action') }}</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ Zero configuration table -->
        </div>
    </div>
<!-- END: Content-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    let adminsTable = $('#farmer-crop-table').DataTable({
        serverSide: true,
        processing: true,

        dom: 'Bfrtip',
        buttons: [
            {text:'excel',
                extend: 'excel',
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [ 1,3,4,5,6,7,8]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns:  [ 1,3,4,5,6,7,8]
                },
                // columns: ':visible',
                autoPrint: true,
                orientation: 'landscape',
                className: 'btn btn-success ml-1',
                pageSize: 'A3',
                text:'print'
            },

        ],
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "language": {
                "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
        ajax: {
            url: '{{ route('farmer_crop.data') }}',
        },
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'farmer', name: 'farmer',searchable: true, sortable: true},
            {data: 'admin', name: 'admin',searchable: true, sortable: true},
            {data: 'village', name: 'village',searchable: true, sortable: true},
            {data: 'w_name', name: 'w_name',searchable: true, sortable: true},
            {data: 's_name', name: 's_name',searchable: true, sortable: true},
            {data: 'winter_area_crop', name: 'winter_area_crop',searchable: true, sortable: true},
            {data: 'summer_area_crop', name: 'summer_area_crop',searchable: true, sortable: true},
            {data: 'date', name: 'date',searchable: true, sortable: true},

            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
        order: [[9, "DESC"]],
    });
</script>
@endsection
