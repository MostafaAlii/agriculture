@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/setting.settingPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\setting.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('farmers.index') }}">{{ __('Admin/site.farmer') }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.newfarmer') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('farmers.store') }}" enctype="multipart/form-data" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/site.firstname') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/site.firstname') }}" name="firstname" value="{{ old('firstname') }}" required>
                                                        @error('firstname')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/site.lastname') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/site.lastname') }}" name="lastname" value="{{ old('lastname') }}" required>
                                                        @error('lastname')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/site.email') }}<span class="text-danger">*</span></label>
                                                        <input type="email" id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/site.email') }}" name="email" value="{{ old('email') }}" required />
                                                        @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput5">{{ __('Admin/site.phone') }}<span class="text-danger">*</span></label>
                                                        <input type="tel" id="eventRegInput5" class="form-control" name="phone" placeholder="{{ __('Admin/site.phone') }}" value="{{ old('phone') }}"
                                                        maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                                                        @error('phone')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                      {{--password--}}
                                                      <div class="form-group">
                                                        <label>{{ __('Admin/site.password') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                                                        @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>

                                                    {{--password_confirmation--}}
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.password_confirmation') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                                                        @error('password_confirmation')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.image') }} :  <span style="color:rgb(199, 8, 8)">*</span></label>
                                                        <input class="form-control img" name="image"  type="file" accept="image/*" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <img src="{{ asset('Dashboard/img/profile.png') }}" class="img-thumbnail img-preview" width="100" alt="">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i>{{ __('Admin/site.personalinfo') }}</h5>
                                                <div class="form-group">
                                                    <div class="controls position-relative">
                                                        <label>{{ __('Admin/site.birthday') }}</label>
                                                        <input type="date" class="form-control birthdate-picker" required placeholder="{{ __('Admin/site.birthday') }}"
                                                        value="{{ old('birthday') }}"
                                                        data-validation-required-message="This birthdate field is required">
                                                        @error('birthdate')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.country') }}</label>
                                                    <select class="select2 form-control" id="country_id" name="country_id">
                                                        <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                        @foreach (\App\Models\Country::get() as $country)
                                                         <option value="{{ $country->id }}" >{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.province') }}</label>
                                                    <select class="select2 form-control" id="province_id" name="province_id">
                                                    </select>
                                                    @error('province_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.area') }}</label>
                                                    <select class="select2 form-control" id="area_id" name="area_id">

                                                    </select>
                                                    @error('area_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.state') }}</label>
                                                    <select class="select2 form-control" id="state_id" name="state_id">
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.village') }}</label>
                                                    <select class="select2 form-control" id="village_id" name="village_id">
                                                    </select>
                                                    @error('village_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i></h5>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.address1') }}</label>
                                                    <input type="text" class="form-control"  value="{{ old('address1') }}"
                                                    name="address1" required data-validation-required-message="This address1 field is required">
                                                    @error('address1')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.address2') }}</label>
                                                    <input type="text" class="form-control"  value="{{ old('address2') }}"
                                                    name="address2" required data-validation-required-message="This address2 field is required">
                                                    @error('address2')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.department') }}</label>
                                                    <select class="form-control" id="accountSelect" name="department_id">
                                                        <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                        @foreach (\App\Models\Department::get() as $department)
                                                         <option value="{{ $department->id }}">{{ $department->name ??null }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('department_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
                                            </button>
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
    <script type="text/javascript">

        var loadFile = function (event) {
            var img = document.getElementById('output');
            img.src = URL.createObjectURL(event.target.files[0]);
            output.img = function () {
                URL.revokeObjectURL(img.src)
            }

        };
    </script>

    <script type="text/javascript">

        var loadFile1 = function (event) {
            var output = document.getElementById('output1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }

        };
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
       //  استعلام بالاجاكس لجلب محافظات البلد ajax for provinces data of country ===============================
           $('select[name="country_id"]').on('change', function() {
                   var country_id = $(this).val();
                   // console.log(country_id);
                   if (country_id) {
                       $.ajax({
                           url: "{{ URL::to('dashboard_admin/admin/province') }}/" + country_id,
                           type: "GET",
                           dataType: "json",
                           success: function(data) {
                               $('select[name="province_id"]').empty();
                               $('select[name="province_id"]').append( '<option selected disabled>--select--</option>');

                               $.each(data, function(key, value) {
                                   // console.log(data);
                                   // console.log(key);
                                   // console.log(value);
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
       //  ajax for area data of province =====================================================================
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
                                   // console.log(data);
                                   // console.log(key);
                                   // console.log(value);
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
                                  // console.log(data);
                                  // console.log(key);
                                  // console.log(value);
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
@endsection

