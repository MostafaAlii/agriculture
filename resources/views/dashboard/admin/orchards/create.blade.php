@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/orchards.orchardsPageTitle') }}
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
                            <li class="breadcrumb-item"><a href="{{ route('Orchards.index') }}">{{ __('Admin/orchards.orchards') }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.neworchard') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('Orchards.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">

                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{__('Admin\orchards.farmer_inf')}}</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{__('Admin\orchards.admin_departments')}}</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{__('Admin\orchards.orchards_inf')}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content " id="myTabContent">
                                                {{--personal information--}}
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row mt-2">
                                                       <div class="col">
                                                        <div class="form-group">
                                                            <label>{{ __('Admin/orchards.area') }}</label>
                                                            <select class="select2 form-control" id="area_id" name="area_id">
                                                                @foreach ($areas as $area)
                                                                {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                                <option value="{{ $area->id }}" >{{ $area->name }}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                       </div>
                                                        <div class="col">

                                                        <div class="form-group">
                                                            <label>{{ __('Admin/orchards.state') }}</label>
                                                            <select class="select2 form-control" id="state_id" name="state_id">
                                                                {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                                {{--<option value="{{ $admin->state_id }}"  >{{ $admin->state->name }}</option>--}}
                                                            </select>
                                                        </div>
                                                    </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/orchards.village') }}</label>
                                                                <select class="select2 form-control" id="village_id" name="village_id">
                                                                    {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                                    {{--<option value="{{ $admin->village_id }}"  >{{ $admin->village->name }}</option>--}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/orchards.farmer') }}</label>
                                                                <select class="select2 form-control" id="farmer_id" name="farmer_id">
                                                                    {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                                    {{--<option value="{{ $admin->village_id }}"  >{{ $admin->village->name }}</option>--}}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/orchards.farmer_email') }}</label>
                                                              <input name="email" class="form-control" value="" type="text" id="farmer_email" disabled>
                                                            </div>

                                                        </div>

                                                    {{--</div>--}}


                                                </div>
                                                    <div class="row mt-2">

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/orchards.farmer_phone') }}</label>
                                                                <input name="phone" class="form-control" value="" type="text" id="farmer_phone" disabled>
                                                            </div>

                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/orchards.farmer_address') }}</label>
                                                                <input name="text" class="form-control" value="" type="text" id="farmer_address" disabled>
                                                            </div>

                                                        </div>


                                                        {{--</div>--}}


                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <div>
                                                        <span>{{__('Admin\orchards.departments')}}</span>
                                                    </div>

                                                    <div id="jstree"></div>
                                                    <input name="admin_department_id" type="hidden" value="" class="admin_department_id">
                                                </div>
                                                {{--end admin department--}}
                                                {{--orcard  information--}}
                                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                                    <div class="row">
                                                        <div class="col">
                                                        <div class="form-group">
                                                                <label>{{ __('Admin/site.treeTypes') }}</label>
                                                                <select class="custom-select form-control" id="customSelect" name="trees=[]" multiple>
                                                                    @foreach($trees as $tree)
                                                                    <option value="{{$tree->id}}">{{ $tree->name }}</option>
                                                                        @endforeach
                                                                </select>

                                                        </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/site.treeTypes') }}</label>
                                                                <select class="custom-select form-control" id="customSelect" name="land_category_id" >
                                                                    @foreach($land_categorys as $land_category)
                                                                        <option value="{{$land_category->id}}">{{ $land_category->category_name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">

                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/site.orchard_area') }}</label>
                                                                <input name="orchard_area" value=""  class="form-control"type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/site.orchard_count_tree') }}</label>
                                                                <input name="count_tree" value=""  class="form-control"type="text">

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{--end orchard information--}}
                                            </div>




                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
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
            //  ajax for get villages data of state =====================================================================
            $('select[name="state_id"]').on('change', function() {
                var state_id = $(this).val();
                // console.log(province_id);
                if (state_id) {
                    $.ajax({
                        url: "{{ URL::to('dashboard_admin/admin/village') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="village_id"]').empty();
                            $('select[name="village_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {
                                // console.log(data);
                                // console.log(key);
                                // console.log(value);
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
                        url: "{{ URL::to('dashboard_admin/Orchards/admin') }}/" + village_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="admin_id"]').empty();
                            $('select[name="admin_id"]').append( '<option selected disabled>--select--</option>');

                            $.each(data, function(key, value) {
                                // console.log(data);
                                // console.log(key);
                                // console.log(value);
                                $('select[name="admin_id"]').append(
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

                    url: "{{ URL::to('dashboard_admin/Orchards/farmerInf') }}/" + farmer_id,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        if(data === undefined) {
                            alert('empty');
                            return;
                        }
                        $('#farmer_phone').val(response.phone);
                        $('#farmer_email').val(response.email);
                        $('#farmer_address').val(response.address);
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
                    'data' :   {!! load_dep() !!},
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

