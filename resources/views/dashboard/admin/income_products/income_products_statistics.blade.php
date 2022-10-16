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
                                    <form class="form" method="POST" action="{{ route('income_product_statistics') }}">
                                        @csrf
                                        <div class="form-body">
                                            @if($admin->type == 'employee')
                                                <div class="row mt-2">
                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="country_id">{{ __('Admin/income_products.country') }}</label>
                                                            <select class="select2 form-control" name="country_id"
                                                                    id="country_id">
                                                                <option selected value = ""disabled>{{__('Admin\orchards.select')}}</option>

                                                            @foreach (App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect">{{ __('Admin/income_products.whole_product_id') }}</label>
                                                            <select class="select2 form-control"  id="customSelect"
                                                                    name="whole_product_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                                @foreach(App\Models\WholeProduct::all() as $product)
                                                                    <option value="{{$product->id}}">{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('whole_product_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror

                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect1-1">{{ __('Admin/income_products.country_product_type') }}</label>
                                                            <select class="select2 form-control"
                                                                    id="customSelect1-1" name="country_product_type">

                                                                <option selected value = ""disabled>{{__('Admin\orchards.select')}}</option>
                                                                <option value="local">{{ __('Admin\income_products.local') }}</option>
                                                                <option value="iraq">{{ __('Admin\income_products.iraq') }}</option>
                                                                <option value="imported">{{ __('Admin\income_products.imported') }}</option>


                                                            </select>
                                                            @error('country_product_type')
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
                                                            <label for="country_id">{{ __('Admin/income_products.country') }}</label>
                                                            <select name="country_id" id="country_id" class="select2 form-control"   >
                                                                <option value="">{{ __('Admin/site.select') }}</option>
                                                                </option>
                                                                @foreach (App\Models\Country::all() as $country)
                                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('country_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="col ">
                                                        <div class="form-group">
                                                            <label for="wholesale_id">{{ __('Admin/income_products.wholesale') }}</label>
                                                            <select name="wholesale_id" id="wholesale_id" class="select2 form-control" >
                                                                <option value="">{{ __('Admin/site.select') }}</option>
                                                                </option>
                                                                @foreach (App\Models\Wholesale::all() as $wholesale)
                                                                    <option value="{{ $wholesale->id }}">{{ $wholesale->Name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('wholesale_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect">{{ __('Admin/income_products.product') }}</label>
                                                            <select class="select2 form-control"  id="customSelect"
                                                                    name="whole_product_id">
                                                                <option value="">{{ __('Admin/site.select') }}</option>

                                                                @foreach(App\Models\WholeProduct::all() as $product)
                                                                    <option value="{{$product->id}}">{{ $product->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('whole_product_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                            @enderror

                                                        </div>
                                                    </div>




                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="customSelect1-1">{{ __('Admin/income_products.country_product_type') }}</label>
                                                            <select class="select2 form-control"
                                                                    id="customSelect1-1" name="country_product_type">
                                                                <option selected value = ""disabled>{{__('Admin\orchards.select')}}</option>
                                                                <option value="local">{{ __('Admin\income_products.local') }}</option>
                                                                <option value="iraq">{{ __('Admin\income_products.iraq') }}</option>
                                                                <option value="imported">{{ __('Admin\income_products.imported') }}</option>


                                                            </select>
                                                            @error('country_product_type')
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
                                                <a type="button" href="{{route('index_income_products')}}" class="btn btn-info">{{__('Admin\p_houses.back')}}</a>

                                            </div>

                                        </div>
                                    </form>
                                    <br/>
                                    @if(isset($income_products))

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration" id="income_product_statistic-table">
                                            <thead>
                                                <tr>


                                                    <th>
                                                    <input type="checkbox" name="select_all" id="select-all">
                                                    </th>
                                                    <th>{{ __('Admin/income_products.country') }}</th>
                                                    <th>{{ __('Admin/income_products.product_name') }}</th>

                                                    <th>{{ __('Admin/income_products.country_product_type') }}</th>
                                                    <th>{{ __('Admin/income_products.admin_dep_name') }}</th>
                                                    <th>{{ __('Admin/income_products.income_product_amount') }}</th>
                                                    <th>{{ __('Admin/income_products.income_product_date') }}</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($income_products as $statistc)
                                            <tr>
                                                <td>#</td>
                                                <td>{{$statistc->country}}</td>
                                                <td>{{$statistc->Product}}</td>

                                                <td>{{$statistc->getCountryProductType()}}</td>
                                                <td>{{$statistc->admin_dep_name}}</td>
                                                <td>{{$statistc->product_amount}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>



     let adminsTable = $('#income_product_statistic-table').DataTable({
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
                 text:'{{trans('Admin\site.print')}}',
             },



         ],


     });
</script>
@endsection
