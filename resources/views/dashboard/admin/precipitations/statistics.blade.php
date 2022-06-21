@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/precipitations.precipitation_report') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/precipitations.precipitation_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">{{ __('Admin/precipitations.precipitation_database_in_all_area') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/precipitations.precipitation_database_in_zawita_station') }}</h4>
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


                                    <form class="form" method="POST" action="{{ route('precipitation_statistics') }}">
                                        @csrf
                                        <div class="form-body">
                                            @if($admin->type == 'employee')
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="farmer_id">{{ __('Admin/bees.state') }}</label>
                                                            <select class="select2 form-control" name="state_id"
                                                                    id="state_id">
                                                                @foreach (App\Models\State::all() as $state)
                                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('state_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col ">
                                                    <div class="form-group">
                                                        <h5>{{__('Admin\precipitations.from_date')}}<span class="text-danger"></span></h5>
                                                        <div class="controls">
                                                            <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                                        @error('start_date')
                                                        <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    </div>

                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <h5>{{__('Admin\precipitations.to_date')}}<span class="text-danger"></span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                                            @error('end_date')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                </div>
                                            @elseif($admin->type =='admin')

                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="area_id">{{ __('Admin/bees.area') }}</label>
                                                            <select name="area_id" id="area_id" class="form-control" required>
                                                                <option value="">{{ __('Admin/site.select') }}</option>
                                                                </option>
                                                                @foreach (App\Models\Area::all() as $area)
                                                                    <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('area_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col ">

                                                        <div class="form-group">
                                                            <label for="state_id">{{ __('Admin/bees.state') }}</label>
                                                            <select class=" form-control" name="state_id" id="state_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                            </select>
                                                            @error('state_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <h5>{{__('Admin\precipitations.from_date')}}<span class="text-danger"></span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="start_date" id="start_date" class="form-control datepicker-autoclose" placeholder="Please select start date"> <div class="help-block"></div></div>
                                                            @error('start_date')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <h5>{{__('Admin\precipitations.to_date')}}<span class="text-danger"></span></h5>
                                                            <div class="controls">
                                                                <input type="date" name="end_date" id="end_date" class="form-control datepicker-autoclose" placeholder="Please select end date"> <div class="help-block"></div></div>
                                                            @error('end_date')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                            @endif

                                            <div class="row">


                                            </div>

                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/orchards.search') }}
                                                </button>
                                                <a type="button" href="{{route('precipitations.index_statistic')}}" class="btn btn-info">{{__('Admin\p_houses.back')}}</a>

                                            </div>

                                        </div>
                                    </form>
                                    <br/>
                                    @if(isset($precipitations))

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="precipitation-statistic-table">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Admin/precipitations.area') }}</th>
                                                    <th>{{ __('Admin/precipitations.state') }}</th>
                                                    <th>{{ __('Admin/precipitations.precipitation_rate') }}</th>
                                                    <th>{{ __('Admin/precipitations.date') }}</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($precipitations as $statistic)
                                                <tr>
                                                    <td>{{ $statistic->area }}</td>
                                                    <td>{{ $statistic->state }}</td>
                                                    <td>{{ $statistic->precipitation_rate }}</td>
                                                    <td>{{ $statistic->date }}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                        @endif
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


    $('#precipitation-statistic-table').DataTable({
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
                    columns: [0,1, 2]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0.1, 2]
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
