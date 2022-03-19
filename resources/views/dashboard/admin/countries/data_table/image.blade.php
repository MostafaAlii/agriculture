
@if($country->country_logo)
    <img style="width:65px; height:65px;border-radius: 5px;" class="rounded-circle" src="{{ $country->country_flag_path }}" alt="{{ $country->name }}" />
@else
    <img style="width:65px; height:65px;border-radius: 5px;" class="rounded-circle" src="{{Url::asset('Dashboard/img/countryFlags/default_flag.jpg')}}" alt="" />
@endif
