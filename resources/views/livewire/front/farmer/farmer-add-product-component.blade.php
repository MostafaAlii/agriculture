@section('title', __('Admin/site.farmeraddproduct'))
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css') }}">
@endsection
<div>
    <!-- start section -->
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

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo" />
        </div>

        {{-- @include('dashboard.common._partials.messages') --}}
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- start checkout -->
                    <div class="checkout">
                        <h2>{{ __('Admin/products.add_new_product') }}</h2>
                        <h1> <a href="{{ route('farmer.product') }}" class="btn btn-primary btn-lg"> <i
                                    class="fa fa-plus"></i> {{ __('Admin/site.back') }}</a></h1>
                        <div class="spacer py-3"></div>

                        <form class="checkout__form" method="post" wire:submit.prevent="store"
                            enctype="multipart/form-data" autocomplete="off">
                            <div class="row justify-content-xl-between">
                                <div class="col-12 col-md-5 col-lg-6">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                @if ($newimage)
                                                    <img src="{{ $newimage->temporaryUrl() }}"
                                                        alt="{{ $newimage->temporaryUrl() }}"
                                                        class=" img-preview users-avatar-shadow rounded-circle "
                                                        width="85px" height="85px" id="output" />
                                                    @error('newimage')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <a class="mr-2" href="#">
                                                        <img src="{{ asset('Dashboard/img/products/default.jpg') }}"
                                                            alt="{{ asset('Dashboard/img/products/default.jpg') }}"
                                                            class="users-avatar-shadow rounded-circle img-preview"
                                                            width="50%">
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="input-wrp">
                                                <input type="file" accept="image/*" name="image" class="textfield"
                                                    wire:model='newimage' required />
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label>{{ __('Admin/products.product_name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input class="textfield"
                                                    placeholder="{{ __('Admin/products.product_name_placeholder') }} *"
                                                    name="product_name" wire:model='product_name'
                                                    wire:keyup='generateslug' value="{{ old('product_name') }}"
                                                    type="text" required />
                                                @error('product_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label>{{ __('Admin/products.product_name') }} <span
                                                        class="text-danger">*</span></label>
                                                <input class="textfield"
                                                    placeholder="{{ __('Admin/products.product_name_placeholder') }} *"
                                                    name="slug" wire:model='slug' type="text" required />
                                                @error('slug')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12">
                                                <label>
                                                    @lang('Admin\products.product_category_select') <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="input-wrp">
                                                    <div wire:ignore>
                                                        <select class="select2 textfield wide js-select"
                                                            id="category-dropdown" multiple wire:model='cat'
                                                            style="width: 38.75em;" required>
                                                            @if ($categories && $categories->count() > 0)
                                                                <option  disabled="disabled">--
                                                                    {{ trans('Admin\products.product_category_select_placeholder') }}
                                                                    --</option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                @error('cat')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label>
                                                    {{ trans('Admin\products.product_tags_select') }} <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div wire:ignore>
                                                    <select class="select2 textfield wide js-select" id="tags" multiple
                                                        wire:model='tag' style="width: 38.75em;" required>
                                                        @if ($tags && $tags->count() > 0)
                                                            <option value="" disabled="disabled">--
                                                                {{ trans('Admin\products.product_tags_select_placeholder') }}
                                                                --</option>
                                                            @foreach ($tags as $tag)
                                                                <option value="{{ $tag->id }}">
                                                                    {{ $tag->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    @error('tag')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label>
                                                    {{ trans('Admin\products.product_units_select') }}
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div wire:ignore>
                                                    <select class="select2 textfield wide js-select" id="units"
                                                        wire:model='unit' style="width: 38.75em;" required >
                                                        <option value=""  readonly selected>
                                                            --{{ trans('Admin\products.product_units_select') }}--
                                                        </option>
                                                        @if($units && $units->count() > 0)
                                                            {{-- <optgroup label="--{{ trans('Admin\products.product_units_select') }}--">
                                                            </optgroup> --}}
                                                                @foreach($units as $unit)
                                                                <option value="{{$unit->id}}">{{$unit->Name}}</option>
                                                                @endforeach
                                                        @endif
                                                    </select>
                                                    @error('unit')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 ">
                                            <div class="input-wrp">
                                                <label for="projectinput1">
                                                    {{ trans('Admin\products.product_main_price') }} <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" name="price" class="textfield"
                                                    placeholder="{{ trans('Admin/products.product_main_price_placeholder') }} *"
                                                    wire:model='price' required />
                                                @error('price')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <p class="row-in-form fill-wife">
                                                <label class="checkbox-field">
                                                    <input name="qty" id="qty" value="1" type="checkbox" wire:model='is_qty'>
                                                    <span>@lang('Admin/site.qty')</span>
                                                </label>
                                            </p>
                                        </div>
                                        @if($is_qty)
                                            <div class="col-12 ">
                                                <div class="input-wrp">
                                                    <label for="projectinput1">
                                                        {{ trans('Admin\products.product_enterqty') }} <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" name="qty" class="textfield"
                                                        placeholder="{{ trans('Admin/products.product_enterqty') }} *"
                                                        wire:model='qty' required />
                                                    @error('qty')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <label for="projectinput1">
                                                    {{ trans('Admin\products.product_description') }}
                                                </label>
                                                <textarea name="desc" class="textfield" wire:model='desc'
                                                    placeholder="{{ trans('Admin\products.product_description_placeholder') }}">

                                                </textarea>
                                                @error('desc')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="spacer py-6"></div>
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">{{ __('Admin/site.save') }}
                                    </button>
                                    <div class="spacer py-6 d-md-none"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end checkout -->
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>
@push('js')
    {{-- <script src="{{ asset('assets/admin/js/jquery-3.6.0-jquery.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/vendors/js/vendors.min.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"></script> --}}
    <script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/js/core/app-menu.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/js/core/app.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/vendors/js/charts/chart.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/js/scripts/modal/components-modal.js')}}"></script> --}}
    {{-- <script src="{{ asset('assets/admin/vendors/js/extensions/dropzone.min.js') }}"></script> --}}
    {{-- <script src="{{asset('assets/admin/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script> --}}
    {{-- <script>
    $(".img").change(function(){
        if(this.files && this.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
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
     async defer"></script> --}}

    <script>
        $(document).ready(function() {
            $('#category-dropdown').select2();
            $('#category-dropdown').on('change', function(e) {
                let data = $(this).val();
                @this.set('cat', data);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#tags').select2();
            $('#tags').on('change', function(e) {
                let data = $(this).val();
                @this.set('tag', data);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#units').select2();
            $('#units').on('change', function(e) {
                let data = $(this).val();
                console.log(data);
                @this.set('unit', data);
            });
        });
    </script>
@endpush
