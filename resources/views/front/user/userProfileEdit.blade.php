@extends('front.layouts.master5')
@section('title', __('website\home.editprofile'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css') }}">
@endsection
@section('content')
    <div>
        <!-- start section -->

        <!-- end section -->
        <section class="section">
            <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}"
                    data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo" />
            </div>

            <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}"
                    data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo" />
            </div>

            <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}"
                    data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo" />
            </div>

            <div class="container">
                <a href="{{ route('farmer.ownprofile') }}" class="custom-btn custom-btn--medium custom-btn--style-1"
                    role="button">
                    @lang('Admin/site.back')
                </a>
                <div class="row">
                    <div class="col-12">
                        <div class="checkout">
                            <h2>@lang('website\home.editprofile')</h2>
                            {{-- <div class="spacer py-3"></div> --}}
                            <form action="{{ route('user.ownprofile.update') }}" class="checkout__form" autocomplete="off" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                @method('put')
                                <div class="row justify-content-xl-between">
                                    <div class="col-12 col-md-5 col-lg-6">
                                        <!-- start form -->
                                        {{--@if (Auth::guard('vendor')->user()->image)
                                            <a class="mr-2" href="#">
                                                <img src="{{ asset('Dashboard/img/users/' . Auth::guard('vendor')->user()->image->filename) }}"
                                                alt="{{ __('Admin/site.no-image') }}"
                                                    class="users-avatar-shadow rounded-circle img-preview" width="50%">
                                            </a>
                                        @else
                                            <a class="mr-2" href="#">
                                                <img src="{{ asset('Dashboard/img/profile.png') }}"
                                                alt="{{ __('Admin/site.no-image') }}"
                                                    class="users-avatar-shadow rounded-circle img-preview" width="50%">
                                            </a>
                                        @endif--}}
                                        <img class="mr-2 users-avatar-shadow rounded-circle img-preview" width="50%"
                                            src=" {{ auth('vendor')->user()->image_path ?
                                            auth('vendor')->user()->image_path : URL::asset('Dashboard/img/Default/default_vendor.jpg') }}"
                                            alt="{{ auth('vendor')->user()->firstname . ' ' . auth('vendor')->user()->lastname }}">
                                        <input type="file" class="textfield img" name="image" accept="image/*">
                                        <!-- end form -->


                                        <p><b>@lang('Admin/site.firstname'): </b>
                                            <input type="text" class="textfield" name="firstname"
                                                value="{{ old('firstname',Auth::guard('vendor')->user()->firstname ) }}">
                                            @error('firstname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>

                                        <p><b>@lang('Admin/site.lastname') : </b> <input type="text" class="textfield"
                                                name="lastname" value="{{ old('lastname',Auth::guard('vendor')->user()->lastname ) }}">
                                            @error('lastname')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p><b>@lang('Admin/site.email') : </b>{{ Auth::guard('vendor')->user()->email }} </p>
                                        <p><b>@lang('Admin/site.phone') : </b> <input type="text" class="textfield" maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                name="phone" value="{{ old('phone',Auth::guard('vendor')->user()->phone) }}">
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p><b>@lang('Admin/site.address1') : </b> <input type="text" class="textfield"
                                                name="address1" value="{{ old('address1',Auth::guard('vendor')->user()->address1) }}">
                                            @error('address1')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p><b>@lang('Admin/site.address2') : </b> <input type="text" class="textfield"
                                                name="address2" value="{{ old('address2',Auth::guard('vendor')->user()->address2) }}">
                                            @error('address2')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <div class="spacer py-6 d-md-none"></div>
                                    </div>

                                    <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                                        <p>
                                            <b>@lang('Admin/site.country') : </b>
                                            <div class="input-wrp">
                                                <select class=" textfield wide js-select select2" id="country_id" name="country_id" >
                                                    <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                    @foreach (\App\Models\Country::get() as $country)
                                                     <option value="{{ $country->id }}" {{Auth::guard('vendor')->user()->country_id == $country->id ? 'selected':'' }}>{{ $country->name ??null}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error(' country_id') <span
                                                class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                            <b>@lang('Admin/site.province') : </b>
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select select2" id="province_id" name="province_id">
                                                    <option value="{{ Auth::guard('vendor')->user()->province_id }}"  >{{ Auth::guard('vendor')->user()->province->name ??null}}</option>
                                                </select>
                                            </div>
                                            @error('province_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                                <b>@lang('Admin/site.area') : </b>
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select select2" id="area_id" name="area_id">
                                                    <option value="{{ Auth::guard('vendor')->user()->area_id }}"  >{{ Auth::guard('vendor')->user()->area->name ??null}}</option>

                                                </select>
                                            </div>
                                            @error('area_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                                <b>@lang('Admin/site.state') : </b>
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select select2" id="state_id" name="state_id">
                                                    <option value="{{ Auth::guard('vendor')->user()->state_id }}"  >{{ Auth::guard('vendor')->user()->state->name ??null}}</option>

                                                </select>
                                            </div>
                                            @error('state_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                                <b>@lang('Admin/site.village') : </b>
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select select2" id="village_id"
                                                    name="village_id">
                                                    <option value="{{ Auth::guard('vendor')->user()->village_id }}"  >{{ Auth::guard('vendor')->user()->village->name ??null}}</option>

                                                </select>
                                            </div>
                                            @error('village_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                                <b>@lang('Admin/site.department') : </b>
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select select2" id="department_id"
                                                    name="department_id">
                                                    <option value="{{ Auth::guard('vendor')->user()->department_id }}"  >{{ Auth::guard('vendor')->user()->department->name ??null}}</option>
                                                    @foreach (\App\Models\Department::get() as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name ??null}}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                            @error('department_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                        <p>
                                                <b>@lang('Admin/site.birthday') : </b>
                                            <div class="input-wrp">
                                                <input type="date" class="textfield birthdate-picker" required name="birthdate"
                                                    placeholder="Birth date" value="{{ Auth::guard('vendor')->user()->birthdate }}"
                                                    data-validation-required-message="This birthdate field is required">
                                            </div>
                                            @error('birthdate')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </p>
                                                <!-- end form -->
                                    </div>
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">@lang('Admin/site.edit')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js') }}"></script>
    <script>
        $(".img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".img-preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    <script>
        $(document).ready(function() {
           //  استعلام بالاجاكس لجلب محافظات البلد ajax for provinces data of country ===============================
               $('select[name="country_id"]').on('change', function() {
                       var country_id = $(this).val();
                    //    console.log(country_id);
                       if (country_id) {
                           $.ajax({
                               url: "{{ URL::to('user/province') }}/" + country_id,
                               type: "GET",
                               dataType: "json",
                               success: function(data) {
                                   $('select[name="province_id"]').empty();
                                   $('select[name="province_id"]').append( '<option selected disabled>--select--</option>');
                                   $.each(data, function(key, value) {
                                    //    console.log(data);
                                    //    console.log(key);
                                    //    console.log(value);
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
                               url: "{{ URL::to('user/area') }}/" + province_id,
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
                              url: "{{ URL::to('user/state') }}/" + area_id,
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
                              url: "{{ URL::to('user/village') }}/" + state_id,
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
@endpush
