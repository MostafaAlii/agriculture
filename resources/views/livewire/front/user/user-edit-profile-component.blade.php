@section('title', __('website\home.editprofile'))
@section('css')

@endsection
<div>
    <!-- start section -->

    <!-- end section -->
	<section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo"/>
        </div>

        <div class="container">
            <a href="{{ route('user.ownprofile') }}" class="custom-btn custom-btn--medium custom-btn--style-1" role="button">
                @lang('Admin/site.back')
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="checkout">
                        <h2>@lang('website\home.editprofile')</h2>
                        {{-- <div class="spacer py-3"></div> --}}
                        <form action="" class="checkout__form" wire:submit.prevent="updateProfile">
                            <div class="row justify-content-xl-between">
                                <div class="col-12 col-md-5 col-lg-6">
                                    <!-- start form -->
                                    @if($newimage)
                                        <a class="mr-2" href="#">
                                                <img src="{{ $newimage->temporaryUrl() }}"
                                                alt="{{ $newimage->temporaryUrl() }}"
                                                class="users-avatar-shadow rounded-circle img-preview"  width="50%">
                                        </a>
                                    @elseif($image)
                                        <a class="mr-2" href="#">
                                                <img src="{{ asset('Dashboard/img/users/'. $image) }}"
                                                alt="{{ asset('Dashboard/img/users/'. $image) }}"
                                                class="users-avatar-shadow rounded-circle img-preview"  width="50%">
                                        </a>
                                    @else
                                        <a class="mr-2" href="#">
                                            <img src="{{ asset('Dashboard/img/users/avatar.jpg') }}"
                                            alt="{{ asset('Dashboard/img/users/avatar.jpg') }}"
                                            class="users-avatar-shadow rounded-circle img-preview"  width="50%">
                                        </a>
                                    @endif
                                    <input type="file" class="textfield" wire:model='newimage'name="image" accept="image/*">
                                    <!-- end form -->
                                    <p><b>@lang('Admin/site.firstname'): </b> <input type="text" class="textfield" wire:model='firstname'>
                                        @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>

                                    <p><b>@lang('Admin/site.lastname') : </b> <input type="text" class="textfield" wire:model='lastname'>
                                        @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.email')    : </b> {{ $email }}</p>
                                    <p><b>@lang('Admin/site.phone')    : </b> <input type="text" class="textfield" wire:model='phone'>
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.address1') : </b> <input type="text" class="textfield" wire:model='address1'>
                                        @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.address2') : </b> <input type="text" class="textfield" wire:model='address2'>
                                        @error('address2')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <div class="spacer py-6 d-md-none"></div>
                                </div>

                                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                                    <p><b>@lang('Admin/site.country')  : </b>
                                        <div class="input-wrp">
                                            <select class="textfield wide js-select" id="country_id" name="country_id" wire:model='country_id'>
                                                <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                @foreach (\App\Models\Country::get() as $country)
                                                <option value="{{ $country->id }}" {{$country_id == $country->id ? 'selected':'' }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.province')  : </b>
                                        <div class="input-wrp">
                                            <select class="textfield wide js-select" id="province_id" name="province_id" wire:model='province_id'>
                                                    <option value="{{ $province_id }}"  > {{ $province_name }} </option>
                                                    @foreach ($provinces as $province)
                                                    <option value="{{ $province->id }}" {{$province_id == $province->id ? 'selected':'' }}>
                                                        {{ $province->name }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @error('province_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.area')  : </b>
                                        <div class="input-wrp">
                                            <select class="textfield wide js-select" id="area_id" name="area_id" wire:model='area_id'>
                                                    <option value="{{ $area_id }}"  >{{ $area_name }}</option>
                                                    @foreach ($areas as $area)
                                                    <option value="{{ $area->id }}" {{$area_id == $area->id ? 'selected':'' }}>
                                                        {{ $area->name }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @error('area_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.state')  : </b>
                                        <div class="input-wrp">
                                            <select class="textfield wide js-select" id="state_id" name="state_id" wire:model='state_id'>
                                                    <option value="{{ $state_id }}"  >{{ $state_name }}</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{ $state->id }}" {{$state_id == $state->id ? 'selected':'' }}>
                                                        {{ $state->name }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @error('state_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.village')  : </b>
                                        <div class="input-wrp">
                                            <select class="textfield wide js-select" id="village_id" name="village_id" wire:model='village_id'>
                                                    <option value="{{ $village_id }}"  >{{ $village_name }}</option>
                                                    @foreach ($villages as $village)
                                                    <option value="{{ $village->id }}" {{$village_id == $village->id ? 'selected':'' }}>
                                                        {{ $village->name }}
                                                    </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        @error('village_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.department')  : </b>
                                        <div class="input-wrp">
                                            <select class=" textfield wide js-select" id="department_id" name="department_id" wire:model='department_id'>
                                                @foreach (\App\Models\Department::get() as $department)
                                                <option value="{{ $department->id }}" {{$department_id == $department->id ? 'selected':'' }}>{{ $department->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        @error('department_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <p><b>@lang('Admin/site.birthday')  : </b>
                                        <div class="input-wrp">
                                            <input type="date" class="textfield birthdate-picker" required placeholder="Birth date"
                                            value="{{ $birthdate }}"
                                            data-validation-required-message="This birthdate field is required" wire:model='birthdate'>
                                        </div>
                                        @error('birthdate')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror</p>
                                    <!-- end form -->
                                </div>
                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">
                                    @lang('Admin/site.edit')
                                </button>
                            </div>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </section>
    <!-- start section -->
    <section class="section section--no-pt section--no-pb section--gutter">
        <div class="container-fluid px-md-0">
            <!-- start banner simple -->
            <div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
                <div class="d-none d-lg-block">
                    <img class="img-logo img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
                </div>

                <div class="row no-gutters">
                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_3.jpg" alt="demo" /></a>
                    </div>

                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_4.jpg" alt="demo" /></a>
                    </div>
                </div>
            </div>
            <!-- end banner simple -->
        </div>
    </section>
    <!-- end section -->
</div>
@push('js')
<script>
    $(document).ready(function() {
       //  استعلام بالاجاكس لجلب محافظات البلد ajax for provinces data of country ===============================
           $('select[name="country_id"]').on('change', function() {
                   var country_id = $(this).val();
                   console.log(country_id);
                   if (country_id) {
                       $.ajax({
                           url: "{{ URL::to('user/province') }}/" + country_id,
                           type: "GET",
                           dataType: "json",
                           success: function(data) {
                               $('select[name="province_id"]').empty();
                               $('select[name="province_id"]').append( '<option selected disabled>--select--</option>');

                               $.each(data, function(key, value) {
                                   console.log(data);
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
