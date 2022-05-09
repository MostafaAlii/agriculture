@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/animals.caw_govermental_supported_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/animals.database_about_animal_projects_that_are_included_in_government_projects') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Admin/animals.caw_govermental_supported') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/animals.caw_govermental_supported_report') }}</h4>
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
                                        <table class="table table-striped table-bordered zero-configuration" id="animals-table">
                                            <thead>

                                            <tr>
                                                <th>
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                </th>

                                                <th>{{ __('Admin/animals.area') }}</th>
                                                <th>{{ __('Admin/animals.state') }}</th>
                                                <th>{{ __('Admin/animals.farmer') }}</th>
                                                <th>{{ __('Admin/animals.farmer_phone') }}</th>
                                                <th>{{ __('Admin/animals.village') }}</th>
                                                {{--<th>{{ __('Admin/animals.type') }}</th>--}}
                                                <th>{{ __('Admin/animals.project_name') }}</th>
                                                <th>{{ __('Admin/animals.hall_num') }}</th>
                                                <th>{{ __('Admin/animals.animal_count') }}</th>
                                                <th>{{ __('Admin/animals.marketing_side') }}</th>
                                                <th>{{ __('Admin/animals.food_source') }}</th>



                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($caw_statistics as $statistic)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{ $statistic->Area }}</td>
                                                    <td>{{ $statistic->State }}</td>
                                                    <td>{{ $statistic->farmer_name }}</td>
                                                    <td>{{ $statistic->phone }}</td>
                                                    <td>{{ $statistic->village_name }}</td>
                                                    {{--<td>{{ $statistic->getType() }}</td>--}}
                                                    <td>{{ $statistic->project_name }}</td>
                                                    <td>{{ $statistic->hall_num }}</td>
                                                    <td>{{ $statistic->animal_count }}</td>
                                                    <td>{{ $statistic->getMarketingSide() }}</td>
                                                    <td>{{ $statistic->getSourceFood() }}</td>


                                                </tr>
                                            @endforeach

                                            </tbody>
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
    let adminsTable = $('#animals-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { text:'excel',
                extend: 'excel',
                orientation: 'landscape',
                pageSize: 'A3',
                exportOptions: {
                    columns: [ 1,2,3,4,5,6,6,7,8,9,10]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1,2,3,4,5,6,6,7,8,9,10]
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
