@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/p_houses.Database_about_greenhouses') }}
@endsection
@section('content')
@include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/p_houses.Database_about_greenhouses') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">{{ __('Admin/site.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ __('Admin/p_houses.report_on_the_number_of_greenhouses') }}</a>
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
                                <h3 class="card-title center" style="color: green">{{ __('Admin/p_houses.report_on_the_number_of_greenhouses') }}</h3>
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
                                    <form class="form" method="POST" action="{{ route('protected_house.statistic') }}">
                                        @csrf
                                        <div class="form-body">
                                            @if($admin->type == 'employee')
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="farmer_id">{{ __('Admin/orchards.village') }}</label>
                                                            <select class="select2 form-control" name="village_id"
                                                                    id="village_id">
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
                                                            <label for="customSelect">{{ __('Admin/orchards.status') }}</label>
                                                            <select class="custom-select form-control" id="customSelect"
                                                                    name="status">
                                                                <option selected value = ""disabled>{{__('Admin\p_houses.select')}}</option>
                                                                <option value="active">{{ __('Admin\p_houses.active') }}</option>
                                                                <option value="inactive">{{ __('Admin\p_houses.inactive') }}</option>
                                                            </select>
                                                            @error('status')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect1-1">{{ __('Admin/orchards.supported_side') }}</label>
                                                            <select class="custom-select form-control"
                                                                    id="customSelect1-1" name="supported_side">
                                                                <option selected value = ""disabled>{{__('Admin\p_houses.select')}}</option>
                                                                <option value="private">{{ __('Admin\p_houses.private') }}</option>
                                                                <option value="govermental">{{ __('Admin\p_houses.govermental') }}</option>
                                                                <option value="international organizations">{{ __('Admin\p_houses.international_organizations') }}</option>

                                                            </select>
                                                            @error('supported_side')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>
                                            @elseif($admin->type =='admin')

                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="area_id">{{ __('Admin/precipitations.area') }}</label>
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
                                                            <label for="state_id">{{ __('Admin/precipitations.state') }}</label>
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
                                                            <label for="farmer_id">{{ __('Admin/orchards.village') }}</label>
                                                            <select class=" form-control" name="village_id" id="village_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                            </select>
                                                            @error('village_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect">{{ __('Admin/p_houses.status') }}</label>
                                                            <select class="custom-select form-control" id="customSelect"
                                                                    name="status">
                                                                <option selected value = ""disabled>{{__('Admin\p_houses.select')}}</option>
                                                                <option value="active">{{ __('Admin\p_houses.active') }}</option>
                                                                <option value="inactive">{{ __('Admin\p_houses.inactive') }}</option>
                                                            </select>
                                                            @error('status')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect1-1">{{ __('Admin/p_houses.supported_side') }}</label>
                                                            <select class="custom-select form-control"
                                                                    id="customSelect1-1" name="supported_side">
                                                                <option selected value = ""disabled>{{__('Admin\p_houses.select')}}</option>
                                                                <option value="private">{{ __('Admin\p_houses.private') }}</option>
                                                                <option value="govermental">{{ __('Admin\p_houses.govermental') }}</option>
                                                                <option value="international organizations">{{ __('Admin\p_houses.international_organizations') }}</option>

                                                            </select>
                                                            @error('supported_side')
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
                                                <a type="button" href="{{route('protected_house_index')}}" class="btn btn-info">{{__('Admin\p_houses.back')}}</a>
                                            </div>

                                        </div>
                                    </form>
                                <hr/>
                                    @if(isset($statistics))
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="animals-table">
                                            <thead>

                                                <tr>
                                                    <th>
                                                        <input type="checkbox" name="select_all" id="select-all">
                                                    </th>

                                                    <th>{{ __('Admin/p_houses.area') }}</th>
                                                    <th>{{ __('Admin/p_houses.state') }}</th>
                                                    <th>{{ __('Admin/p_houses.farmer') }}</th>
                                                    <th>{{ __('Admin/p_houses.farmer_phone') }}</th>
                                                    <th>{{ __('Admin/p_houses.village') }}</th>
                                                    <th>{{ __('Admin/p_houses.status') }}</th>
                                                    <th>{{ __('Admin/p_houses.count_protected_house') }}</th>

                                                    <th>{{ __('Admin/p_houses.average_product_annual') }}</th>
                                                    <th>{{ __('Admin/p_houses.unit') }}</th>
                                                    <th>{{ __('Admin/p_houses.supported_side') }}</th>


                                                </tr>
                                            <tbody>
                                            @foreach($statistics as $statistic)
                                                <tr>
                                                    <td>#</td>
                                                    <td>{{ $statistic->Area }}</td>
                                                    <td>{{ $statistic->State }}</td>
                                                    <td>{{ $statistic->farmer_name }}</td>
                                                    <td>{{ $statistic->phone }}</td>
                                                    <td>{{ $statistic->village_name }}</td>
                                                    <td>{{ $statistic->getStatus() }}</td>
                                                    <td>{{ $statistic->count_protected_house }}</td>

                                                    <td>{{ $statistic->average_product_annual }}</td>
                                                    <td>{{ $statistic->unit_name }}</td>
                                                    <td>{{ $statistic->getSupportedSide() }}</td>


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
    let adminsTable = $('#animals-table').DataTable({
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
                    columns: [ 1,2,3,5,6,7,8,9,10]
                },
                className: 'btn btn-primary ml-1',

            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 1,2,3,5,6,7,8,10]
                },
                autoPrint: true,
                orientation: 'landscape',
                className: 'btn btn-success ml-1',
                pageSize: 'A3',
                text:'{{trans('Admin\site.print')}}',
            },



        ],

    });
</script>
@endsection
