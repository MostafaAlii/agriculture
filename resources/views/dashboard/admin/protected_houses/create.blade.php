@extends('dashboard.layouts.dashboard')
@section('css')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/p_houses.protectedHousePageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\p_houses.protectedHousePageTitle')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Areas.index') }}">{{ $area_name }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('States.index') }}">{{ $state_name }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('ProtectedHouse.index') }}">{{ __('Admin/p_houses.protectedHouses') }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/p_houses.newprotectedHouse') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('ProtectedHouse.store') }}" >
                                        @csrf
                                        @method('post')
                                        <div class="form-body">

                                                    <div class="row mt-2">
                                                        <div class="col col-md-6">
                                                            <div class="form-group">
                                                                <label for="village_id">{{ __('Admin/p_houses.village') }}</label>
                                                                <select name="village_id" id="village_id" class="form-control" required>
                                                                    <option value="">{{ __('Admin/site.select') }}</option>
                                                                    </option>
                                                                    @foreach ($villages as $village)
                                                                        <option value="{{ $village->id }}">{{ $village->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="col col-md-6">
                                                            <div class="form-group">
                                                                <label for="farmer_id">{{ __('Admin/p_houses.farmer') }}</label>
                                                                <select class="select2 form-control" name="farmer_id" id="farmer_id" required="required">

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                   <div class="row mt-2">

                                                       <div class="col col-md-6">
                                                           <div class="form-group">
                                                               <label for="customSelect1">{{ __('Admin/p_houses.supported_side') }}</label>
                                                               <select class="custom-select form-control" id="customSelect1" name="supported_side" >
                                                                   <option selected disabled>--select--</option>
                                                                       <option value="private">{{ __('Admin\p_houses.private')}}</option>
                                                                   <option value="govermental">{{ __('Admin\p_houses.govermental')}}</option>
                                                                   <option value="international organizations">{{ __('Admin\p_houses.international_organizations')}}</option>


                                                               </select>

                                                           </div>
                                                       </div>
                                                       <div class="col col-md-6">
                                                           <div class="form-group">
                                                               <label  for="count_protected_house_id">{{ __('Admin/p_houses.count_protected_house') }}</label>
                                                               <input name="count_protected_house"   id="count_protected_house_id"typ="text" class="form-control">
                                                               <input name="admin_id"  id="admin_id"type="hidden"  value="{{$adminId}}"class="form-control">
                                                               <input name="area_id"  id="area_id"type="hidden"  value="{{$areaID}}"class="form-control">
                                                               <input name="state_id"  id="state_id"type="hidden"  value="{{$stateID}}"class="form-control">

                                                           </div>
                                                       </div>

                                                    </div>


                                                   <div class="row">
                                                        <div class="col col-md-4">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/p_houses.average_product_annual') }}</label>
                                                                <input name="average_product_annual" value=""  class="form-control"type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/p_houses.unit') }}</label>
                                                                <select class="custom-select form-control" id="customSelect" name="unit_id" >
                                                                    <option selected disabled>--select--</option>

                                                                @foreach($units as $unit)
                                                                        <option value="{{$unit->id}}">{{ $unit->Name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col col-md-4">
                                                            <div class="form-group">
                                                                <label>{{ __('Admin/p_houses.status') }}</label>
                                                                <select class="custom-select form-control" id="customSelect" name="status" >
                                                                        <option  disabled>--select--</option>
                                                                        <option value="active" >{{ __('Admin/p_houses.active') }}</option>
                                                                        <option value="inactive">{{ __('Admin/p_houses.inactive') }}</option>

                                                                </select>
                                                            </div>
                                                        </div>


                                                   </div>

                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/p_houses.save') }}
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
                        $('#farmer_email').val(data.email);
                    }


                });
            }else {
                console.log('AJAX load did not work');
            }

        });

    </script>

{{--departments--}}


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

