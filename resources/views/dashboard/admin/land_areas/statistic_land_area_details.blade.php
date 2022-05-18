@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/land_areas.land_areas_details_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/land_areas.land_areas_details_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Admin/land_areas.database_about_land_areas_details') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/land_areas.database_about_land_areas_details') }}</h4>
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
                                        <table class="table table-striped table-bordered zero-configuration" id="land-area-statistic-details-table">
                                            <thead>
                                                <tr>
                                                    <th>


                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/land_areas.area') }}</th>
                                                    <th>{{ __('Admin/land_areas.state') }}</th>
                                                    <th>{{ __('Admin/land_areas.village') }}</th>
                                                    <th>{{ __('Admin/land_areas.rocky_lands_and_pastures') }}</th>
                                                    <th>{{ __('Admin/land_areas.natural_forests') }}</th>
                                                    <th>{{ __('Admin/land_areas.municipal_lands') }}</th>

                                                    <th>{{ __('Admin/land_areas.public_restrooms') }}</th>
                                                    <th>{{ __('Admin/land_areas.govermental_biulding') }}</th>
                                                    <th>{{ __('Admin/land_areas.irrigated_orchard') }}</th>
                                                    <th>{{ __('Admin/land_areas.rainy_orchard') }}</th>
                                                    <th>{{ __('Admin/land_areas.irrigated_land') }}</th>
                                                    <th>{{ __('Admin/land_areas.rainy_land') }}</th>
                                                    <th>{{ __('Admin/land_areas.kamariat') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($statistics as $statistic)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{$statistic->Area}}</td>
                                                    <td>{{$statistic->State}}</td>
                                                    <td>{{$statistic->Village}}</td>
                                                    <td>{{$statistic->rocky_lands_and_pastures}}</td>
                                                    <td>{{$statistic->natural_forests}}</td>
                                                    <td>{{$statistic->municipal_lands}}</td>

                                                    <td>{{$statistic->public_restrooms}}</td>
                                                    <td>{{$statistic->govermental_biulding}}</td>
                                                    <td>{{$statistic->irrigated_orchard}}</td>
                                                    <td>{{$statistic->rainy_orchard}}</td>
                                                    <td>{{$statistic->irrigated_land}}</td>
                                                    <td>{{$statistic->rainy_land}}</td>
                                                    <td>{{$statistic->kamariat}}</td>

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

    $('#land-area-statistic-details-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { text:'excel',
                extend: 'excel',
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [ 1,2,3,4,5,6,7,8,9,10,11,12,13]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns:  [ 1,2,3,4,5,6,7,8,9,10,11,12,13]
                },
                autoPrint: true,
                orientation: 'landscape',
                className: 'btn btn-success ml-1',
                pageSize: 'A3',
                text:'print'
            },



        ],
    } );

</script>
@endsection
