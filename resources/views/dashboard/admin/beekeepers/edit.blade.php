@extends('dashboard.layouts.dashboard')
@section('css')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/orchards.beekeeperPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\bees.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('BeeKeepers.index') }}">{{ __('Admin/bees.beekeepers') }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.editbeekeeper') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('BeeKeepers.update',($beekeeper->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">

                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="area_id">{{ __('Admin/bees.area') }}</label>
                                                        <select name="area_id" id="area_id" class="form-control" required>
                                                            <option value="">{{ __('Admin/site.select') }}</option>
                                                            </option>
                                                            <option value="{{$beekeeper->area_id }}" selected>{{ $beekeeper->area->name }}</option>
                                                            @foreach ($areas as $area)
                                                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label for="state_id">{{ __('Admin/bees.state') }}</label>
                                                        <select class="select2 form-control" name="state_id" id="state_id">
                                                            <option value="{{$beekeeper->state_id}}" selected>{{$beekeeper->state->name}}</option>

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="village_id">{{ __('Admin/bees.village') }}</label>
                                                        <select class="select2 form-control" name="village_id" id="village_id">
                                                            <option value="{{$beekeeper->village_id}}" selected>{{$beekeeper->village->name}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="farmer_id">{{ __('Admin/bees.farmer') }}</label>
                                                        <select class="select2 form-control" name="farmer_id" id="farmer_id">
                                                            <option value="{{$beekeeper->farmer_id}}" selected>{{$beekeeper->farmer->firstname}}</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label  for="admin_id">{{ __('Admin/bees.farmer_phone') }}</label>
                                                        <input name="phone" value="{{$beekeeper->phone}}" id="farmer_phone"typ="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label  for="admin_id">{{ __('Admin/bees.farmer_email') }}</label>
                                                        <input name="email"  value="{{$beekeeper->email}}" id="farmer_email"typ="text" class="form-control">
                                                    </div>
                                                </div>



                                            </div>

                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div  class="form-group mb-3">
                                                        <label class="">{{__('Admin\bees.departments')}}</label>
                                                        <hr>
                                                        <div id="jstree"></div>
                                                        <input name="admin_department_id" type="hidden" value="{{$beekeeper->admin_department_id}}" class="admin_department_id">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.old_beehive_count') }}</label>
                                                        <input name="old_beehive_count" value="{{$beekeeper->old_beehive_count}}"  class="form-control"type="number">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.new_beehive_count') }}</label>
                                                        <input name="new_beehive_count" value="{{$beekeeper->new_beehive_count}}" class="form-control"type="number">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.annual_old_product_beehive') }}</label>
                                                        <input name="annual_old_product_beehive" value="{{$beekeeper->annual_old_product_beehive}}" class="form-control"type="text">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.annual_new_product_beehive') }}</label>
                                                        <input name="annual_new_product_beehive" value="{{$beekeeper->annual_new_product_beehive}}" class="form-control"type="text">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.unit') }}</label>
                                                        <select class="custom-select form-control" id="customSelect" name="unit_id" >
                                                            <option value="{{$beekeeper->unit_id}}">{{$beekeeper->unit->Name}}</option>

                                                             @foreach($units as $unit)
                                                                <option value ="{{$unit->id}}">{{ $unit->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>




                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="customSelect1">{{ __('Admin/bees.supported_side') }}</label>
                                                        <select class="custom-select form-control" id="customSelect1" name="supported_side_id" >
                                                            <option selected disabled>--select--</option>
                                                            @foreach($supported_sides as $supported_side)
                                                                <option value="{{$supported_side->id}}"{{$beekeeper->supported_side_id==$supported_side->id?'selected':''}}>{{ $supported_side->Name }}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div  class="form-group">
                                                        <label for="id_h5_multi">{{ __('Admin/bees.courses') }}</label>

                                                        <select name="courses[]"class="select2 form-control"name="courses[]" multiple="multiple" id="id_h5_multi">
                                                            @foreach($beekeeper->coursebees as $coursebee)
                                                                <option value="{{$coursebee->id}}"selected>{{$coursebee->name}}</option>
                                                            @endforeach
                                                            @foreach($courses as $cours)
                                                                <option value="{{$cours->id}}" >{{ $cours->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/bees.died_beehive_count') }}</label>
                                                        <input name="died_beehive_count" value="{{$beekeeper->died_beehive_count}}" class="form-control"type="text">
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div  class="form-group">
                                                        <label for="id_h5_multi_1">{{ __('Admin/bees.disaster') }}</label>

                                                        <select name="disasters[]"class="select2 form-control"name="disasters[]" multiple="multiple" id="id_h5_multi_1">
                                                            @foreach($beekeeper->beedisasters as $beedisaster)
                                                                <option value="{{$beedisaster->id}}"selected>{{$beedisaster->name}}</option>
                                                            @endforeach
                                                            @foreach($disasters as $disaster)
                                                                <option value="{{$disaster->id}}" >{{ $disaster->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/bees.update') }}
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
            $('select[name="area_id"]').on('change', function() {
                var area_id = $(this).val();
                // console.log(province_id);
                if (area_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/state') }}/" + area_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="state_id"]').empty();
                            $('select[name="state_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="state_id"]').append(
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
            //  ajax for get villages data of area =====================================================================
            $('select[name="state_id"]').on('change', function() {
                var state_id = $(this).val();
                console.log(state_id);
                if (area_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/village') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="village_id"]').empty();
                            $('select[name="village_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {

                                $('select[name="village_id"]').append(
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
            //  استعلام بالاجاكس لجلب محافظات البلد ajax for provinces data of country ===============================
            $('select[name="village_id"]').on('change', function() {
                var village_id = $(this).val();
                // console.log(village_id);
                if (village_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/orchards/farmer') }}/" + village_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="farmer_id"]').empty();
                            $('select[name="farmer_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {
                                // console.log(data);
                                // console.log(key);
                                // console.log(value);
                                $('select[name="farmer_id"]').append(
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
        $('select[name="farmer_id"]').on('change', function() {

            var farmer_id = $(this).val();
            if(farmer_id){
                $.ajax({

                    url: "{{ URL::to('dashboard_admin/orchards/farmerInf') }}/" + farmer_id,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        if(data === undefined) {
                            alert('empty');
                            return;
                        }
                        $('#farmer_phone').val(data.phone);
                        $('#farmer_email').val(response.email);
                        $('#farmer_address').val(response.address1);
                    }


                });
            }else {
                console.log('AJAX load did not work');
            }

        });

    </script>

    {{--departments--}}

    <script  type="text/javascript">

        $(document).ready(function () {

            $('#jstree').jstree({
                "core" : {
                    'data' :   {!! load_dep($beekeeper->admin_department_id) !!},
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

