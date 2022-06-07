@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
     @lang('Admin/site.profiledit')
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- users edit start -->
            <section class="users-edit">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="nav nav-tabs mb-2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                        <i class="ft-user mr-25"></i><span class="d-none d-sm-block">   @lang('Admin/site.profiledit')</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                        <i class="ft-info mr-25"></i><span class="d-none d-sm-block">@lang('Admin/site.information')</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                    <!-- users edit media object start -->

                                    <!-- users edit media object ends -->
                                    <!-- users edit account form start -->
                                    <form novalidate action="{{ route('farmer.updateAccount', encrypt($farmer->id)) }}"  enctype="multipart/form-data" method="post" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="media mb-2">
                                            @if($farmer->image)
                                                <a class="mr-2" href="#">
                                                    <img
                                                    src="{{ asset('Dashboard/img/admins/'. $farmer->image->filename) }}"
                                                    alt="{{ asset('Dashboard/img/admins/'. $farmer->image->filename) }}"
                                                    class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                                                </a>
                                            @else
                                                <a class="mr-2" href="#">
                                                    <img src="{{ asset('Dashboard/img/farmers/avatar.jpg') }}"
                                                    alt="{{ asset('Dashboard/img/farmers/avatar.jpg') }}"
                                                    class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                                                </a>
                                            @endif


                                            <div class="media-body">
                                                <h4 class="media-heading"> @lang('Admin/site.image')</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <a href="#" class="btn btn-sm btn-primary mr-25">
                                                        <input class="form-control img" name="image"  type="file" accept="image/*">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.firstname') }}</label>
                                                        <input type="text" class="form-control" placeholder="Username" value="{{ old('firstname',$farmer->firstname) }}"
                                                        name="firstname" required data-validation-required-message="This firstname field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.lastname') }}</label>
                                                        <input type="text" class="form-control"  value="{{ old('lastname',$farmer->lastname) }}"
                                                        name="lastname" required data-validation-required-message="This lastname field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.phone') }}</label>
                                                        <input type="text" class="form-control"  name="phone"  value="{{ old('phone',$farmer->phone) }}"
                                                        required data-validation-required-message="This phone field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.email') }}</label>
                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email',$farmer->email) }}"
                                                        required data-validation-required-message="This email field is required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                    {{ __('Admin/site.save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- users edit account form ends -->
                                </div>
                                <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <form novalidate action="{{ route('farmer.updateInformation', encrypt($farmer->id)) }}"  method="post" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i>{{ __('Admin/site.personalinfo') }}</h5>
                                                <div class="form-group">
                                                    <div class="controls position-relative">
                                                        <label>{{ __('Admin/site.birthday') }}</label>
                                                        <input type="date" class="form-control birthdate-picker" required placeholder="Birth date"
                                                        value="{{ $farmer->birthdate }}"
                                                        data-validation-required-message="This birthdate field is required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.country') }}</label>
                                                    <select class="select2 form-control" id="country_id" name="country_id">
                                                        <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                        @foreach (\App\Models\Country::get() as $country)
                                                         <option value="{{ $country->id }}" {{$farmer->country_id == $country->id ? 'selected':'' }}>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.province') }}</label>
                                                    <select class="select2 form-control" id="province_id" name="province_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $farmer->province_id }}"  >{{ $farmer->province->name }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.area') }}</label>
                                                    <select class="select2 form-control" id="area_id" name="area_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $farmer->area_id }}"  >{{ $farmer->area->name }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.state') }}</label>
                                                    <select class="select2 form-control" id="state_id" name="state_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $farmer->state_id }}"  >{{ $farmer->state->name }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.village') }}</label>
                                                    <select class="select2 form-control" id="village_id" name="village_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $farmer->village_id }}"  >{{ $farmer->village->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i></h5>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.address1') }}</label>
                                                    <input type="text" class="form-control"  value="{{ old('lastname',$farmer->address1) }}"
                                                    name="address1" required data-validation-required-message="This address1 field is required">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.address2') }}</label>
                                                    <input type="text" class="form-control"  value="{{ old('lastname',$farmer->address2) }}"
                                                    name="address2" required data-validation-required-message="This address2 field is required">
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.department') }}</label>
                                                    <select class="form-control" id="accountSelect" name="department_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $farmer->department_id }}"  >{{ $farmer->department->name }}</option>
                                                        @foreach (\App\Models\Department::get() as $department)
                                                         <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            {{-- <div class="col-12">
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control" placeholder="Website address">
                                                </div>
                                                <div class="form-group">
                                                    <label>Favourite Music</label>
                                                    <select class="form-control" id="users-music-select2" multiple="multiple">
                                                        <option value="Rock">Rock</option>
                                                        <option value="Jazz" selected>Jazz</option>
                                                        <option value="Disco">Disco</option>
                                                        <option value="Pop">Pop</option>
                                                        <option value="Techno">Techno</option>
                                                        <option value="Folk" selected>Folk</option>
                                                        <option value="Hip hop">Hip hop</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Favourite movies</label>
                                                    <select class="form-control" id="users-movies-select2" multiple="multiple">
                                                        <option value="The Dark Knight" selected>The Dark Knight
                                                        </option>
                                                        <option value="Harry Potter" selected>Harry Potter</option>
                                                        <option value="Airplane!">Airplane!</option>
                                                        <option value="Perl Harbour">Perl Harbour</option>
                                                        <option value="Spider Man">Spider Man</option>
                                                        <option value="Iron Man" selected>Iron Man</option>
                                                        <option value="Avatar">Avatar</option>
                                                    </select>
                                                </div>
                                            </div> --}}
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                    {{ __('Admin/site.save') }}</button>
                                                {{-- <button type="reset" class="btn btn-light">Cancel</button> --}}
                                            </div>
                                        </div>
                                    </form>
                                    <!-- users edit Info form ends -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- users edit ends -->
        </div>
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
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
