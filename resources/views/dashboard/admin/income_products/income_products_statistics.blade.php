@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/income_products.income_products_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/income_products.income_products_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{ __('Admin/income_products.database_about_income_products') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/income_products.database_about_income_products') }}</h4>
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


                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="income_product_statistic-table">
                                            <thead>
                                                <tr>


                                                    <th>
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/income_products.country') }}</th>
                                                    <th>{{ __('Admin/income_products.country_product_type') }}</th>
                                                    <th>{{ __('Admin/income_products.dep_name') }}</th>
                                                    <th>{{ __('Admin/income_products.product_name') }}</th>
                                                    <th>{{ __('Admin/income_products.income_product_amount') }}</th>
                                                    <th>{{ __('Admin/income_products.income_product_price') }}</th>
                                                    <th>{{ __('Admin/income_products.income_product_date') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($statistics as $statistc)
                                            <tr>
                                                <td>#</td>
                                                <td>{{$statistc->country}}</td>
                                                <td>{{$statistc->getCountryProductType()}}</td>
                                                <td>{{$statistc->admin_dep_name}}</td>
                                                <td>{{$statistc->product_name}}</td>
                                                <td>{{$statistc->income_product_amount}}</td>
                                                <td>{{$statistc->income_product_price}}</td>
                                                <td>{{$statistc->income_product_date}}</td>
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



     let adminsTable = $('#income_product_statistic-table').DataTable({
         dom: 'Bfrtip',
         buttons: [
                { text:'excel',
                 extend: 'excel',
                 orientation: 'landscape',
                 pageSize: 'A3',
                 exportOptions: {
                     columns: [ 2,3,4,5,6,7,1]
                 },
                 className: 'btn btn-primary ml-1',

               },
             {
                 extend: 'print',
                 exportOptions: {
                     columns:  [ 1,2,3,4, 5,6,7]
                 },
                 autoPrint: true,
                 orientation: 'landscape',
                 className: 'btn btn-success ml-1',
                 pageSize: 'A3',
                 text:'print'
             },



         ],


     });
</script>
@endsection
