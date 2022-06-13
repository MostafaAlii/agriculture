@extends('dashboard.layouts.dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" integrity="sha512-uyGg6dZr3cE1PxtKOCGqKGTiZybe5iSq3LsqOolABqAWlIRLo/HKyrMMD8drX+gls3twJdpYX0gDKEdtf2dpmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/products.productPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start content-wrapper -->
    <div class="content-wrapper">
        <!-- Start content-header -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\products.add_new_product')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{-- route('products') --}}">{{ __('Admin/products.productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{-- route('products.generalInformation') --}}">{{ __('Admin/products.add_new_product') }}</a>
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
        <!-- End content-header -->
        <!-- Start content-body -->
        <div class="content-body">
            <!-- Start card-content -->
            <div class="card-content collapse show">
                <div class="card-body">
                    <!-- Start Product Wizard -->
                    <section id="validation">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{trans('Admin\products.add_new_product')}}</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
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
                                            <form action="#" class="steps-validation wizard-circle">
                                                <!-- Start Step 1 -->
                                                <h6>{{ trans('Admin/products.general_product_information') }}</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <x-dashboard.inputs.input class="form-control" name="name" :label=" __('Admin/products.product_name')" />
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <x-dashboard.inputs.select class="js-example-basic-single form-control" name="farmer_id" :options="$farmers->pluck('firstname', 'id')" :label=" __('Admin\products.product_farmer_select')" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <x-dashboard.inputs.select class="js-example-basic-single form-control" multiple name="categories" :options="$categories->pluck('name', 'id')" :label=" __('Admin\products.product_category_select')" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <x-dashboard.inputs.input type="checkbox" :label="trans('Admin\products.product_status')" value="1" name="status" id="switcheryColor4" data-color="success" class="js-switch" checked />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- End Step 1 -->

                                                <!-- Start Step 2 -->
                                                <h6>Step 2</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="proposalTitle3">
                                                                    Proposal Title :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="proposalTitle3" name="proposalTitle">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="emailAddress6">
                                                                    Email Address :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="email" class="form-control required" id="emailAddress6" name="emailAddress">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="videoUrl3">Video URL :</label>
                                                                <input type="url" class="form-control" id="videoUrl3" name="videoUrl">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="jobTitle5">
                                                                    Job Title :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="jobTitle5" name="jobTitle">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shortDescription3">Short Description :</label>
                                                                <textarea name="shortDescription" id="shortDescription3" rows="4" class="form-control"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- End Step 2 -->

                                                <!-- Start Step 3 -->
                                                <h6>Step 3</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="eventName3">
                                                                    Event Name :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="eventName3" name="eventName">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="eventType3">
                                                                    Event Type :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <select class="custom-select form-control required" id="eventType3" name="eventType">
                                                                    <option value="Banquet">Banquet</option>
                                                                    <option value="Fund Raiser">Fund Raiser</option>
                                                                    <option value="Dinner Party">Dinner Party</option>
                                                                    <option value="Wedding">Wedding</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="eventLocation3">Event Location :</label>
                                                                <select class="custom-select form-control" id="eventLocation3" name="eventLocation">
                                                                    <option value="">Select City</option>
                                                                    <option value="Amsterdam">Amsterdam</option>
                                                                    <option value="Berlin">Berlin</option>
                                                                    <option value="Frankfurt">Frankfurt</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="eventDate">
                                                                    Event Date - Time :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <div class='input-group'>
                                                                    <input type='text' class="form-control datetime required" id="eventDate" name="eventDate" />
                                                                    <span class="input-group-addon">
                                                                        <span class="ft-calendar"></span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="eventStatus3">
                                                                    Event Status :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <select class="custom-select form-control required" id="eventStatus3" name="eventStatus">
                                                                    <option value="Planning">Planning</option>
                                                                    <option value="In Progress">In Progress</option>
                                                                    <option value="Finished">Finished</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Requirements :</label>
                                                                <div class="c-inputs-stacked">
                                                                    <div class="d-inline-block custom-control custom-checkbox">
                                                                        <input type="checkbox" name="status3" class="custom-control-input" id="staffing3">
                                                                        <label class="custom-control-label" for="staffing3">Staffing</label>
                                                                    </div>
                                                                    <div class="d-inline-block custom-control custom-checkbox">
                                                                        <input type="checkbox" name="status3" class="custom-control-input" id="catering3">
                                                                        <label class="custom-control-label" for="catering3">Catering</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- End Step 3 -->

                                                <!-- Start Step 4 -->
                                                <h6>Step 4</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="meetingName3">
                                                                    Name of Meeting :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="meetingName3" name="meetingName">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="meetingLocation3">
                                                                    Location :
                                                                    <span class="danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control required" id="meetingLocation3" name="meetingLocation">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="participants3">Names of Participants</label>
                                                                <textarea name="participants" id="participants3" rows="4" class="form-control"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="decisions3">Decisions Reached</label>
                                                                <textarea name="decisions" id="decisions3" rows="4" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Agenda Items :</label>
                                                                <div class="c-inputs-stacked">
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="agenda3" class="custom-control-input" id="item31">
                                                                        <label class="custom-control-label" for="item31">1st item</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="agenda3" class="custom-control-input" id="item32">
                                                                        <label class="custom-control-label" for="item32">2nd item</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="agenda3" class="custom-control-input" id="item33">
                                                                        <label class="custom-control-label" for="item33">3rd item</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="agenda3" class="custom-control-input" id="item34">
                                                                        <label class="custom-control-label" for="item34">4th item</label>
                                                                    </div>
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="agenda3" class="custom-control-input" id="item35">
                                                                        <label class="custom-control-label" for="item35">5th item</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- End Step 4 -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- End Product Wizard -->
                </div>
                <!-- End card-content -->
            </div>
        </div>
        <!-- End content-body -->
    </div>
    <!-- End content-wrapper -->
</div>
<!-- END: Content-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
<script>
    var loadFile = function (event) {
        var img = document.getElementById('output');
        img.src = URL.createObjectURL(event.target.files[0]);
        output.img = function () {
            URL.revokeObjectURL(img.src)
        }

    };
</script>
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
    $("#pac-input").focusin(function() {
        $(this).val('');
    });
    $('#latitude').val('');
    $('#longitude').val('');
    // This example adds a search box to a map, using the Google Place Autocomplete
    // feature. People can enter geographical searches. The search box will return a
    // pick list containing a mix of places and predicted search terms.
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 36.688831, lng: 42.98341 },
            zoom: 13,
            mapTypeId: 'roadmap'
        });
        // move pin and current location
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(pos),
                    map: map,
                    title: 'موقعك الحالي'
                });
                markers.push(marker);
                marker.addListener('click', function() {
                    geocodeLatLng(geocoder, map, infoWindow,marker);
                });
                // to get current position address on load
                google.maps.event.trigger(marker, 'click');
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            console.log('dsdsdsdsddsd');
            handleLocationError(false, infoWindow, map.getCenter());
        }
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initAutocomplete&language=ar
     async defer"></script>
@endsection
