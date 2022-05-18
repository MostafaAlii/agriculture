@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/bees.beekeeperPageTitle') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/bees.beekeeperPageTitle') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        @if($admin->type == 'employee')
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('Areas.index') }}">{{ $area_name }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('States.index') }}">{{ $state_name }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('BeeKeepers.index') }}">{{ __('Admin/bees.beekeeperPageTitle') }}</a>
                                </li>
                                </li>
                            </ol>
                        @else

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('BeeKeepers.index') }}">{{ __('Admin/bees.beekeeperPageTitle') }}</a>
                                </li>

                            </ol>
                        @endif
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
                                <h4 class="card-title">{{ __('Admin/bees.beekeepers') }}</h4>
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
                                    <a href="{{ route('BeeKeepers.create') }}" class="btn btn-primary btn-sm mb-3"><i class="material-icons">add_box</i> {{ __('Admin/site.create') }}</a>
                                    <button type="button" class="btn btn-warning mb-3"
                                        id="btn_delete_all" data-toggle="modal"
                                        data-target="#bulkdelete" >
                                        <i class="fa fa-trash"></i>
                                        {{ __('Admin/site.bulkdelete') }}
                                    </button>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="beekeeper-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/bees.farmer') }}</th>
                                                    <th>{{ __('Admin/bees.admin') }}</th>
                                                    <th>{{ __('Admin/bees.area') }}</th>
                                                    <th>{{ __('Admin/bees.state') }}</th>
                                                    <th>{{ __('Admin/bees.village') }}</th>
                                                    <th>{{ __('Admin/bees.old_beehive_count') }}</th>
                                                    <th>{{ __('Admin/bees.new_beehive_count') }}</th>
                                                    <th>{{ __('Admin/bees.died_beehive_count') }}</th>

                                                    <th>{{ __('Admin/bees.annual_old_product_beehive') }}</th>
                                                    <th>{{ __('Admin/bees.annual_new_product_beehive') }}</th>
                                                    <th>{{ __('Admin/bees.supported_side') }}</th>

                                                    <th>{{ __('Admin/bees.courses') }}</th>
                                                    <th>{{ __('Admin/bees.disasters') }}</th>
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
    let adminsTable = $('#beekeeper-table').DataTable({

        serverSide: true,
        processing: true,

        dom: 'Bfrtip',
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "language": {
                "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
        ajax: {
            url: '{{ route('beekeepers.data') }}',
        },
        buttons: [
            {text:'excel',
                extend: 'excel',
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [ 1,3,4,5,6,7,8,9,10,11]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns:  [ 1,3,4,5,6,7,8,9,10,11]
                },
                // columns: ':visible',
                autoPrint: true,
                orientation: 'landscape',
                className: 'btn btn-success ml-1',
                pageSize: 'A3',
                text:'print'
            },

        ],


        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'farmer', name: 'farmer.email',searchable: true, sortable: true},
            {data: 'admin', name: 'admin',searchable: true, sortable: true},
            {data: 'area', name: 'area',searchable: true, sortable: true},
            {data: 'state', name: 'state',searchable: true, sortable: true},
            {data: 'village', name: 'village.name',searchable: true, sortable: true},
            {data: 'old_beehive_count', name: 'old_beehive_count.name',searchable: true, sortable: true},
            {data: 'new_beehive_count', name: 'new_beehive_count.name',searchable: true, sortable: true},
            {data: 'died_beehive_count', name: 'died_beehive_count.name',searchable: true, sortable: true},

            {data: 'annual_old_product_beehive', name: 'annual_old_product_beehive.name',searchable: true, sortable: true},
            {data: 'annual_new_product_beehive', name: 'annual_new_product_beehive.name',searchable: true, sortable: true},
            {data: 'supported_side', name: 'supported_side',searchable: true, sortable: true},
            {data: 'c_name', name: 'c_name'},
            {data: 'd_name', name: 'd_name'},
            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
        ],
        order: [[3, 'desc']],
    });
</script>
@endsection
