

@if($country->country_logo)
    <a href="#">
        <img src="{{ asset('Dashboard/img/countries/'. $country->country_logo) }}" style="width: 100px; height: 100px;" alt="">
    </a>

@else
    <a href="#">
        <img src="{{ asset('Dashboard/img/countries/avatar.jpg') }}" style="width: 100px;" alt="">
    </a>

@endif
