@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/products.product_title_in_sidebar') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">grain</i>
                    {{ trans('Admin/products.product_title_in_sidebar') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('products') }}">{{ trans('Admin/products.product_title_in_sidebar') }}</a>
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
                                <h4 class="card-title">{{ trans('Admin/products.product_title_in_sidebar') }}</h4>
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
                                    <a href="{{ route('products.generalInformation') }}" class="btn btn-primary btn-sm mb-3">
                                        <i class="material-icons">add_box</i>
                                        {{ __('Admin/products.add_new_product') }}
                                    </a>
                                    <a href="{{-- route('products.product_trashed') --}}" class="btn btn-warning btn-sm mb-3">
                                        <i class="material-icons">delete_sweep</i>
                                        {{ __('Admin/products.trashed_product') }}
                                    </a>
                                    <button type="button" class="btn btn-danger btn-md mb-3"
                                        id="btn_delete_all" data-toggle="modal"
                                        data-target="#bulkdelete" >
                                        {{ __('Admin/site.bulkdelete') }}
                                    </button>
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <!-- Start Table -->
                                        <table class="table table-striped table-bordered zero-configuration" id="products-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/products.product_main_image') }}</th>
                                                    <th>{{ __('Admin/products.product_name') }}</th>
                                                    <th>{{ __('Admin/products.product_farmer') }}</th>
                                                    <th>{{ __('Admin/products.product_status') }}</th>
                                                     <th>{{ __('Admin/products.product_category') }}</th>
                                                     <th>{{ __('Admin/products.product_price') }}</th>
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
            </section>
            <!-- End Zero configuration table -->
        </div>
        <!-- End Content Body -->
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Datatable Fire -->

<script>

    let productsTable = $('#products-table').DataTable({
        // dom: "tiplr",
        serverSide: true,
        processing: true,
        lengthMenu: [[10, 25, 50, 100, 500], [10, 25, 50, 100, 500]],
        "language": {
                "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
        ajax: {
            url: '{{ route("products_data") }}',
        },
        columns: [
            {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
            {data: 'image', name: 'image', searchable: false, sortable: false, width: '10%'},
            {data: 'name', name: 'name'},
            {data: 'farmer_name', name: 'farmer_name'},
            {data: 'status', name: 'status'},
            {data: 'category_name', name: 'category_name'},
            {data: 'price', name: 'price', searchable: false, sortable: false},
            {data: 'created_at', name: 'created_at', searchable: false, sortable: false},
            {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '18%'},
        ],
        order: [[5, 'desc']],

    });
</script>

@endsection
