@extends('dashboard.layouts.dashboard')
@section('css')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/income_products.income_productPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\income_products.income_productPageTitle')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('AdminDepartments.index') }}">{{ $admin_dep_name }}</a>
                            </li>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('IncomeProducts.index') }}">{{ __('Admin/income_products.income_productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.edit') }}
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/income_products.edit_incomeProductPageTitle') }}</h4>
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
                                <div class="card-body">
                                    <form class="form" method="post" action="{{ route('IncomeProducts.update',encrypt($income_product->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">

                                            <div class="row mt-2">
                                                <div class="col col-md-4 ">
                                                    <div class="form-group">
                                                        <label for="whole_product_id">{{ __('Admin/income_products.whole_product') }}</label>
                                                        <select name="whole_product_id" id="whole_product_id" class=" select2 form-control"  required="required">
                                                            <option value="">{{ __('Admin/site.select') }}</option>
                                                            </option>
                                                            <option value="{{$income_product->whole_product_id }}" selected>{{ $income_product->whole_product->name }}</option>
                                                            @foreach ($whole_products as $whole_product)
                                                                <option value="{{ $whole_product->id }}">{{ $whole_product->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label for="country_id">{{ __('Admin/income_products.country') }}</label>
                                                        <select name="country_id" id="country_id" class="select2 form-control"  required="required">
                                                            <option value="">{{ __('Admin/site.select') }}</option>
                                                            </option>
                                                            <option value="{{$income_product->country_id }}" selected>{{ $income_product->country->name }}</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col col-md-4">

                                                    <div class="form-group">
                                                        <label for="country_product_type-1">{{ __('Admin/income_products.country_product_type') }}</label>
                                                        <select class="select2 form-control" name="country_product_type" id="country_product_type-1"  required="required">
                                                            <option value="">{{ __('Admin/site.select') }}</option>
                                                            <option value="local" {{$income_product->country_product_type == 'local'?'selected':'' }}>{{ __('Admin/income_products.local') }}</option>
                                                            <option value="iraq" {{$income_product->country_product_type == 'iraq'?'selected':'' }}>{{ __('Admin/income_products.iraq') }}</option>
                                                            <option value="imported" {{$income_product->country_product_type == 'imported'?'selected':'' }}>{{ __('Admin/income_products.imported') }}</option>


                                                        </select>

                                                    </div>
                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col col-md-4">

                                                    <div class="form-group">
                                                        <label for="wholesale_id-1">{{ __('Admin/income_products.wholesale') }}</label>
                                                        <select class="select2 form-control" id="wholesale_id-1" name="wholesale_id"  required="required">
                                                            <option value="{{$income_product->wholesale_id}}">{{$income_product->wholesale->Name}}</option>

                                                            @foreach(App\Models\Wholesale::all() as $wholesale)
                                                                <option value ="{{$wholesale->id}}">{{ $wholesale->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/income_products.income_product_amount') }}</label>
                                                        <input name="income_product_amount" value="{{$income_product->income_product_amount}}"  required="required"  class="form-control"type="text">
                                                        <input name="admin_dep_name" value="{{$admin_dep_name}}"  class="form-control"type="hidden">

                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/income_products.unit') }}</label>
                                                        <select class="custom-select form-control" id="customSelect" name="unit_id"  required="required">
                                                            <option value="{{$income_product->unit_id}}">{{$income_product->unit->Name}}</option>

                                                             @foreach($units as $unit)
                                                                <option value ="{{$unit->id}}">{{ $unit->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/income_products.income_product_price') }}</label>
                                                        <input name="income_product_price" value="{{$income_product->income_product_price}}"  required="required" class="form-control"type="text">
                                                        <input name="admin_id" value="{{$adminID}}"  class="form-control"type="hidden">

                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/income_products.currency') }}</label>
                                                        <select class="select2 form-control" id="customSelect" name="currency_id"  required="required" >
                                                            <option value="{{$income_product->currency_id}}">{{$income_product->currency->Name}}</option>                                                            @foreach($currencies as $currency)
                                                                <option value="{{$currency->id}}">{{ $currency->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col col-md-4">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/income_products.income_product_date') }}</label>
                                                        <input name="income_product_date"value="{{$income_product->income_product_date}}"  required="required" class="form-control"type="date">

                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/outcome_products.update') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
@section('js')

    <script>
        $(document).ready(function() {
            //  ajax for get states data of area =====================================================================
            $('select[name="country_id"]').on('change', function() {
                var country_id = $(this).val();
                if (area_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/province') }}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="province_id"]').empty();
                            $('select[name="province_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="province_id"]').append(
                                    '<option value="' + key + '">' + value +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            //  ajax for get states data of area =====================================================================
            $('select[name="province_id"]').on('change', function() {
                var province_id = $(this).val();
                // console.log(province_id);
                if (province_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/area') }}/" + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="area_id"]').empty();
                            $('select[name="area_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="area_id"]').append(
                                    '<option value="' + key + '">' + value +'</option>'
                                );
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script src="{{ asset('assets/admin/js/jquery-1.12.1.min.js')}}"></script>
    <script src="{{asset('assets/admin/jstree/jstree.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        $('select').select2({
            theme: 'bootstrap4',
        });

    </script>

@endsection

