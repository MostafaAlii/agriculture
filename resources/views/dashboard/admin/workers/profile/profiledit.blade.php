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
                                    <form novalidate action="{{ route('worker.updateAccount', encrypt($worker->id)) }}"  enctype="multipart/form-data" method="post" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="media mb-2">
                                            @if($worker->image)
                                                <a class="mr-2" href="#">
                                                        <img src="{{ asset('Dashboard/img/workers/'. $worker->image->filename) }}"
                                                        alt="{{ __('Admin/site.no-image') }}"
                                                        class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                                                </a>
                                            @else
                                                <a class="mr-2" href="#">
                                                    <img src="{{ asset('Dashboard/img/profile.png') }}"
                                                    alt="{{ __('Admin/site.no-image') }}"
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
                                                        <input type="text" class="form-control" placeholder="Username" value="{{ old('firstname',$worker->firstname) }}"
                                                        name="firstname" required data-validation-required-message="This firstname field is required">
                                                        @error('firstname')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.lastname') }}</label>
                                                        <input type="text" class="form-control"  value="{{ old('lastname',$worker->lastname) }}"
                                                        name="lastname" required data-validation-required-message="This lastname field is required">
                                                        @error('lastname')
                                                        <span class="text-danger">{{$message}}</span>
                                                      @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.phone') }}</label>
                                                        <input type="text" class="form-control"  name="phone"  value="{{ old('phone',$worker->phone) }}"
                                                        required  maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                                        data-validation-required-message="This phone field is required" />
                                                        @error('phone')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.email') }}</label>
                                                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email',$worker->email) }}"
                                                        required data-validation-required-message="This email field is required">
                                                        @error('email')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.status') }}</label>
                                                        <select class="custom-select" id="customSelect" name="status" value="{{ $worker->status }}">
                                                            <option value="{{ $worker->status }}" disabled selected >{{$worker->status == 1 ?  __('Admin/site.active') : __('Admin/site.unactive')}}</option>
                                                            <option value= '1'>{{ __('Admin/site.active') }}</option>
                                                            <option value= '0'>{{ __('Admin/site.unactive') }}</option>
                                                        </select>
                                                        @error('status')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.worktype') }}</label>
                                                        <select class="custom-select" id="customSelect" name="work" value="{{ $worker->work }}">
                                                            <option value="{{ $worker->work }}" disabled selected >{{$worker->work == 'alone' ?  __('Admin/site.alone') : __('Admin/site.team')}}</option>
                                                            <option value="alone">{{ __('Admin/site.alone') }}</option>
                                                            <option value="team">{{ __('Admin/site.team') }}</option>
                                                        </select>
                                                        @error('work')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label>{{ __('Admin/site.salarytype') }}</label>
                                                        <select class="custom-select salary" id="customSelect" name="salary">
                                                            <option value="{{ $worker->salary }}" disabled selected >{{$worker->salary == 'perday' ?  __('Admin/site.perday') : __('Admin/site.perhour')}}</option>
                                                            <option value="perday">{{ __('Admin/site.perday') }}</option>
                                                            <option value="perhour">{{ __('Admin/site.perhour') }}</option>
                                                        </select>
                                                        @error('salary')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group myInput">
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mymoney">
                                                            <label for="eventRegInput5">{{ __('Admin/site.money') }}<span class="text-danger">*</span></label>
                                                            <select class="custom-select salary" id="customSelect" name="currency_id">
                                                                <option  selected disabled>{{ __('Admin/site.select') }}</option>
                                                                @foreach($currencies as $currency)
                                                                  <option value="{{ $currency->id }}"{{ $currency->id == $worker->currency->id ? 'selected':'' }}>{{ $currency->Name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.password') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password" class="form-control"
                                                        placeholder="{{ __('Admin/site.enter_new_password') }}" required>
                                                        @error('password')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    {{--password_confirmation--}}
                                                    <div class="form-group">
                                                        <label>{{ __('Admin/site.password_confirmation') }}<span class="text-danger">*</span></label>
                                                        <input type="password" name="password_confirmation" class="form-control"
                                                        placeholder="{{ __('Admin/site.enter_passord_confirm') }}"
                                                        value="{{ old('password_confirmation') }}" required>
                                                        @error('password_confirmation')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                    {{ __('Admin/site.save') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                    <!-- users edit Info form start -->
                                    <form novalidate action="{{ route('worker.updateInformation', encrypt($worker->id)) }}"  method="post" autocomplete="off">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mt-1 mt-sm-0">
                                                <h5 class="mb-1"><i class="ft-user mr-25"></i>{{ __('Admin/site.personalinfo') }}</h5>
                                                <div class="form-group">
                                                    <div class="controls position-relative">
                                                        <label>{{ __('Admin/site.birthday') }}</label>
                                                        <input type="date" class="form-control birthdate-picker" required placeholder="{{ __('Admin/site.birthday') }}"
                                                        value="{{ old('birthday',$worker->birthdate) }}"
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
                                                         <option value="{{ $country->id }}" {{$worker->country_id == $country->id ? 'selected':'' }}>{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('country_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.province') }}</label>
                                                    <select class="select2 form-control" id="province_id" name="province_id">
                                                        @if($worker->province_id == null)
                                                         <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                        @else
                                                        <option value="{{ $worker->province_id }}"  >{{ $worker->province->name ??null}}</option>
                                                        @endif
                                                    </select>
                                                    @error('province_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.area') }}</label>
                                                    <select class="select2 form-control" id="area_id" name="area_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $worker->area_id }}"  >{{ $worker->area->name ??null}}</option>
                                                    </select>
                                                    @error('area_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.state') }}</label>
                                                    <select class="select2 form-control" id="state_id" name="state_id">
                                                        {{-- <option disabled selected>{{ __('Admin/site.select') }}</option> --}}
                                                        <option value="{{ $worker->state_id }}"  >{{ $worker->state->name ??null}}</option>
                                                    </select>
                                                    @error('state_id')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.village') }}</label>
                                                    <select class="select2 form-control" id="village_id" name="village_id">
                                                        @if($worker->village_id ==null)
                                                         <option disabled selected>{{ __('Admin/site.select') }}</option>
                                                        @else
                                                        <option value="{{ $worker->village_id }}"  >{{ $worker->village->name ??null}}</option>
                                                        @endif
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
                                                    <input type="text" class="form-control"  value="{{ old('lastname',$worker->address1) }}"
                                                    name="address1" required data-validation-required-message="This address1 field is required">
                                                    @error('address1')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>{{ __('Admin/site.address2') }}</label>
                                                    <input type="text" class="form-control"  value="{{ old('lastname',$worker->address2) }}"
                                                    name="address2" required data-validation-required-message="This address2 field is required">
                                                    @error('address2')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label for="projectinput1">
                                                        {{ trans('Admin\site.desc') }}
                                                    </label>
                                                    <textarea name="desc" class="form-control" id="description"
                                                    placeholder="{{ trans('Admin\site.desc') }}">
                                                     {{ $worker->desc }}
                                                    </textarea>

                                                    @error("desc")
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>

                                            </div>


                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
                                                    {{ __('Admin/site.save') }}</button>
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
    selector: '#description',
    directionality : 'rtl',
    language: 'ar',
    height: 300,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
  });
</script>

<script>
    $(".salary").on('change',function(){
        var select = $(".salary").val();
             if(select =="perday"){
                $('.myInput').empty()
                $('.myInput').append(`<label for="eventRegInput5">{{ __('Admin/site.daily') }}<span class="text-danger">*</span></label>
                                      <input type="text" id="eventRegInput5" class="form-control" name="daily_price" placeholder="{{ __('Admin/site.daily') }}"
                                      value="{{ $worker->daily_price }}" required>`)
             }
            else if(select =="perhour"){
                $('.myInput').empty()
                $('.myInput').append(`<label for="eventRegInput5">{{ __('Admin/site.hourly') }}<span class="text-danger">*</span></label>
                                      <input type="text" id="eventRegInput5" class="form-control" name="hourly_price" placeholder="{{ __('Admin/site.hourly') }}"
                                      value="{{ $worker->hourly_price }}" required>`)
             }
             else{
                $('.myInput').empty()
             }
    });
</script>
{{--start map edit code--}}
<script>
    $("#pac-input").focusin(function() {
        $(this).val('');
    });
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initAutocomplete() {
        var pos = {lat : {{ $worker->latitude }} ,  lng :{{ $worker->longitude }} };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: pos
        });
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        marker = new google.maps.Marker({
            position: pos,
            map: map,
            title: '{{ $worker->firstname }}'
        });
        infoWindow.setContent('{{ $worker->firstname }}');
        infoWindow.open(map, marker);
        // move pin and current location
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        var geocoder = new google.maps.Geocoder();
        google.maps.event.addListener(map, 'click', function(event) {
            SelectedLatLng = event.latLng;
            geocoder.geocode({
                'latLng': event.latLng
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        deleteMarkers();
                        addMarkerRunTime(event.latLng);
                        SelectedLocation = results[0].formatted_address;
                        console.log( results[0].formatted_address);
                        splitLatLng(String(event.latLng));
                        $("#pac-input").val(results[0].formatted_address);
                    }
                }
            });
        });
        function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
            var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
            /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
            $('#latitude').val(markerCurrent.position.lat());
            $('#longitude').val(markerCurrent.position.lng());
            geocoder.geocode({'location': latlng}, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        map.setZoom(8);
                        var marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                        markers.push(marker);
                        infowindow.setContent(results[0].formatted_address);
                        SelectedLocation = results[0].formatted_address;
                        $("#pac-input").val(results[0].formatted_address);
                        infowindow.open(map, marker);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
            SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
        }
        function addMarkerRunTime(location) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }
        function setMapOnAll(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }
        function clearMarkers() {
            setMapOnAll(null);
        }
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }
        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        $("#pac-input").val("أبحث هنا ");
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
        });
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();
            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
            markers = [];
            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
                if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                var icon = {
                    url: place.icon,
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                };
                // Create a marker for each place.
                markers.push(new google.maps.Marker({
                    map: map,
                    icon: icon,
                    title: place.name,
                    position: place.geometry.location
                }));
                $('#latitude').val(place.geometry.location.lat());
                $('#longitude').val(place.geometry.location.lng());
                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });
    }
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
    function splitLatLng(latLng){
        var newString = latLng.substring(0, latLng.length-1);
        var newString2 = newString.substring(1);
        var trainindIdArray = newString2.split(',');
        var lat = trainindIdArray[0];
        var Lng  = trainindIdArray[1];
        $("#latitude").val(lat);
        $("#longitude").val(Lng);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKZAuxH9xTzD2DLY2nKSPKrgRi2_y0ejs&libraries=places&callback=initAutocomplete&language=ar&region=EG
         async defer"></script>
{{--end map edit code--}}



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
<script  type="text/javascript">

    $(document).ready(function () {

        $('#jstree').jstree({
            "core" : {
                'data' :   {!! load_dep($worker->admin_department_id) !!},
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
@endsection
