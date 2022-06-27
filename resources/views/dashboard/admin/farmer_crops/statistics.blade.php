@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/crops.farmer_crops_report') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/crops.farmer_crops_report') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">


                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="">{{ __('Admin/crops.database_about_farmer_crops') }}</a>
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
                                <h4 class="card-title">{{ __('Admin/crops.farmer_crops_report') }}</h4>
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

                                    <form class="form" method="POST" action="{{ route('statistics') }}">
                                        @csrf
                                        <div class="form-body">
                                            @if($admin->type == 'employee')
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="farmer_id">{{ __('Admin/bees.village') }}</label>
                                                            <select class="select2 form-control" name="village_id"
                                                                    id="state_id">
                                                                @foreach (App\Models\Village::all() as $village)
                                                                    <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('village_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect">{{ __('Admin/orchards.land_category_id') }}</label>
                                                            <select class="custom-select form-control" id="customSelect"
                                                                    name="land_category_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                            @foreach($land_categories as $land_category)
                                                                    <option value="{{$land_category->id}}">{{ $land_category->category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('land_category_id')
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
                                                            <select name="area_id" id="area_id" class="form-control" >
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
                                                            <label for="state_id">{{ __('Admin/bees.village') }}</label>
                                                            <select class=" form-control" name="village_id" id="village_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                            </select>
                                                            @error('village_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror

                                                        </div>
                                                    </div>




                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect">{{ __('Admin/orchards.land_category_id') }}</label>
                                                            <select class="custom-select form-control" id="customSelect"
                                                                    name="land_category_id">
                                                            <option value="">{{ __('Admin/site.select') }}</option>

                                                            @foreach($land_categories as $land_category)
                                                                    <option value="{{$land_category->id}}">{{ $land_category->category_name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('land_category_id')
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
                                                <a type="button" href="{{route('statistics_index')}}" class="btn btn-info">{{__('Admin\p_houses.back')}}</a>

                                            </div>

                                        </div>
                                    </form>
                                    <br/>
                                    @if(isset($statistics))


                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration"
                                               id="farmer_crops_statistic-table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                </th>
                                                <th>{{ __('Admin/crops.area') }}</th>
                                                <th>{{ __('Admin/crops.state') }}</th>
                                                <th>{{ __('Admin/crops.village') }}</th>
                                                <th>{{ __('Admin/crops.farmer') }}</th>
                                                {{--<th>{{ __('Admin/crops.summer_area_crop') }}</th>--}}
                                                <th>{{ __('Admin/crops.summer_area_crop') }}</th>
                                                <th>{{ __('Admin/crops.winter_area_crop') }}</th>

                                                <th>{{ __('Admin/crops.category_name') }}</th>
                                                <th>{{ __('Admin/crops.date') }}</th>

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
                                                    <td>{{$statistc->summer_area_crop}}</td>
                                                    <td>{{$statistc->winter_area_crop}}</td>

                                                    <td>{{$statistc->category_name}}</td>

                                                    <td>{{$statistc->date}}</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"
            integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js"
            integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>


        let adminsTable = $('#farmer_crops_statistic-table').DataTable({
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
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    className: 'btn btn-primary ml-1',

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    },
                    autoPrint: true,
                    orientation: 'landscape',
                    className: 'btn btn-success ml-1',
                    pageSize: 'A3',
                    text:'{{trans('Admin\site.print')}}',                },


            ],


        });
    </script>
@endsection
