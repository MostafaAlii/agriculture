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
                <h3 class="content-header-title">{{trans('Admin\orchards.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('IncomeProducts.index') }}">{{ __('Admin/income_products.income_productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.add') }}
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/income_products.new_income_product') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('IncomeProducts.store') }}" >
                                        @csrf
                                        @method('post')
                                        <div class="form-body">

                                                    <div class="row mt-2">
                                                        <div class="col col-md-3">
                                                            <div class="form-group">
                                                                <label for="area_id">{{ __('Admin/income_products.whole_product') }}</label>
                                                                <select name="whole_product_id" id="area_id" class="form-control" required>
                                                                    <option value="">{{ __('Admin/site.select') }}</option>
                                                                    </option>
                                                                    @foreach ($whole_products as $whole_product)
                                                                        <option value="{{ $whole_product->id }}">{{ $whole_product->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col col-md-3">
                                                            <div class="form-group">
                                                                <label for="area_id">{{ __('Admin/income_products.country') }}</label>
                                                                <select name="country_id" id="area_id" class="form-control" required>
                                                                    <option value="">{{ __('Admin/site.select') }}</option>
                                                                    </option>
                                                                    @foreach ($countries as $country)
                                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col col-md-3">

                                                            <div class="form-group">
                                                                <label for="state_id">{{ __('Admin/income_products.province') }}</label>
                                                                <select class=" form-control" name="province_id" id="province_id">
                                                                    <option value="">{{ __('Admin/site.select') }}</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col col-md-3">

                                                            <div class="form-group">
                                                                <label for="state_id">{{ __('Admin/income_products.area') }}</label>
                                                                <select class=" form-control" name="area_id" id="area_id">
                                                                    <option value="">{{ __('Admin/site.select') }}</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                    </div>





                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <div  class="form-group mb-3">
                                                                <label class="">{{__('Admin\precipitations.departments')}}</label>
                                                                <hr>
                                                                <div id="jstree"></div>
                                                                <input name="admin_department_id" type="hidden" value="" class="admin_department_id">

                                                            </div>
                                                        </div>
                                                    </div>
                                                   <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/income_products.income_product_amount') }}</label>
                                                                <input name="income_product_amount" value=""  class="form-control"type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/income_products.unit') }}</label>
                                                                <select class="custom-select form-control" id="customSelect" name="unit_id" >
                                                                    <option selected disabled>--select--</option>
                                                                    @foreach($units as $unit)
                                                                        <option value="{{$unit->id}}">{{ $unit->Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                       <div class="col">
                                                           <div class="form-group">
                                                               <label>{{ __('Admin/income_products.income_product_price') }}</label>
                                                               <input name="income_product_price" value=""  class="form-control"type="text">
                                                           </div>
                                                       </div>
                                                       <div class="col">
                                                           <div class="form-group">
                                                               <label>{{ __('Admin/income_products.currency') }}</label>
                                                               <select class="custom-select form-control" id="customSelect" name="currency_id" >
                                                                   <option selected disabled>--select--</option>
                                                                   @foreach($currencies as $currency)
                                                                       <option value="{{$currency->id}}">{{ $currency->Name }}</option>
                                                                   @endforeach
                                                               </select>
                                                           </div>
                                                       </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/income_products.income_product_date') }}</label>
                                                                <input name="income_product_date" value=""  class="form-control"type="date">

                                                            </div>
                                                        </div>


                                                   </div>

                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/income_products.save') }}
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



{{--departments--}}

    <script  type="text/javascript">

        $(document).ready(function () {

            $('#jstree').jstree({
                "core" : {
                    'data' :   {!! load_dep(old('admin_department_id')) !!},
                    "themes" : {
                        "variant" : "large"
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "wholerow",  ]
            });
        });


        $('#jstree')
        // listen for event
            .on('changed.jstree', function (e, data) {
                var i, j,r = [];
                var name=[];
                for(i=0,j=data.selected.length;i<j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);

                }
                $('.admin_department_id').val(r.join(', '));



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

