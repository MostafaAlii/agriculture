@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/income_products.income_iraq_products_details_in_date_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/income_products.income_iraq_products_details_in_date_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{ __('Admin/income_products.income_iraq_products_database_details_in_date_report') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/income_products.income_iraq_products_details_in_date_report') }}</h4>
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
                                    <!-- Start Filter -->
                                    @can('income-iraq-product-statistics-filter')
                                        <h2>{{__('Admin\precipitations.choose_date')}}</h2>
                                    <form action="{{route('dtable_weekly_monthly_anual_income_iraq_product')}}" method="get">
                                        <div class="form-group col-md-6">
                                            <h5>{{__('Admin\precipitations.from_date')}}<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5>{{__('Admin\precipitations.to_date')}}<span class="text-danger"></span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                        </div>
                                        <div class="text-left" style="    margin-left: 15px;  ">
                                            <button type="submit" id="btnFiterSubmitSearch" class="btn btn-info">{{__('Admin\precipitations.submit')}}</button>
                                        </div>
                                    </form>
                                    @endcan
                                    <!-- End Filter -->

                                    <br>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="income_iraq_products_periodly-statistic-table">
                                            <thead>
                                                <tr>

                                                    <th>{{ __('Admin/income_products.country') }}</th>
                                                    <th>{{ __('Admin/income_products.admin_dep_name') }}</th>
                                                    <th>{{ __('Admin/income_products.product') }}</th>
                                                    <th>{{ __('Admin/income_products.iraq_product') }}</th>
                                                    <th>{{ __('Admin/income_products.date') }}</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($income_products as $statistc)
                                                <tr>

                                                    <td>{{$statistc->country}}</td>
                                                    <td>{{$statistc->admin_dep_name}}</td>
                                                    <td>{{$statistc->Product}}</td>
                                                    <td>{{$statistc->iraq_product}}</td>
                                                    <td>{{$statistc->date}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
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


    $('#income_iraq_products_periodly-statistic-table').DataTable({
        dom: 'Bfrtip',
        "language": {
            "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
        },

        buttons: [
            {
                text: '{{trans('Admin\site.excel')}}',
                extend: 'excel',
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [0,1, 2,3,4]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1, 2,3,4]
                },
                autoPrint: true,
                orientation: 'landscape',
                className: 'btn btn-success ml-1',
                pageSize: 'A3',
                text: '{{trans('Admin\site.print')}}',
            },


        ],
    });
</script>
@endsection
