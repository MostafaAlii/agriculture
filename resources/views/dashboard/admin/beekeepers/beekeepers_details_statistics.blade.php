@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/bees.Apiaries_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/bees.Apiaries_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">


                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('BeeKeepers.index') }}">{{ __('Admin/bees.database_about_of_breeders') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/bees.database_about_of_breeders') }}</h4>
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
                                        <table class="table table-striped table-bordered zero-configuration" id="beekeeper-table">
                                            <thead>
                                                <tr>

                                                    <th>
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                    </th>

                                                    <th>{{ __('Admin/bees.area') }}</th>
                                                    <th>{{ __('Admin/bees.state') }}</th>
                                                    <th>{{ __('Admin/bees.village') }}</th>
                                                    <th>{{ __('Admin/bees.farmer') }}</th>
                                                    <th>{{ __('Admin/bees.old_beehive_count') }}</th>
                                                    <th>{{ __('Admin/bees.new_beehive_count') }}</th>
                                                    <th>{{ __('Admin/bees.supported_side') }}</th>
                                                    <th>{{ __('Admin/bees.annual_new_product_beehive') }}</th>
                                                    <th>{{ __('Admin/bees.annual_old_product_beehive') }}</th>
                                                    <th>{{ __('Admin/bees.cost') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($statistics as $statistc)
                                            <tr>
                                                <td>#</td>
                                                <td>{{$statistc->Area}}</td>
                                                <td>{{$statistc->State}}</td>
                                                <td>{{$statistc->Village}}</td>
                                                <td>{{$statistc->farmer}}</td>
                                                <td>{{$statistc->old_beehive_count}}</td>
                                                <td>{{$statistc->new_beehive_count}}</td>
                                                <td>{{$statistc->getSupportedSide()}}</td>
                                                <td>{{$statistc->annual_new_product_beehive}}</td>
                                                <td>{{$statistc->annual_old_product_beehive}}</td>
                                                <td>{{$statistc->cost}}</td>
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



     let adminsTable = $('#beekeeper-table').DataTable({
         dom: 'Bfrtip',
         "language": {
             "url": "{{ asset('assets/admin/datatable-lang/' . app()->getLocale() . '.json') }}"
         },

         buttons: [
                {
                text:'{{trans('Admin\site.excel')}}',
                extend: 'excel',
                 orientation: 'landscape',
                 pageSize: 'A3',
                 exportOptions: {
                     columns: [ 2,3,4,5,6,7,1,8,9,10]
                 },
                 className: 'btn btn-primary ml-1',

               },
             {
                 extend: 'print',
                 exportOptions: {
                     columns:   [ 2,3,4,5,6,7,1,8,9,10]
                 },
                 autoPrint: true,
                 orientation: 'landscape',
                 className: 'btn btn-success ml-1',
                 pageSize: 'A3',
                 text:'{{trans('Admin\site.print')}}',             },



         ],


     });
</script>
@endsection
