@section('title', __('website\home.my_profile'))
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
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <h2>@lang('website\home.my_profile')</h2>

                    <!-- start form -->
                    @if($user->image->filename)
                        <a class="mr-2" href="#">
                                <img src="{{ asset('Dashboard/img/admins/'. $user->image->filename) }}"
                                alt="{{ asset('Dashboard/img/admins/'. $user->image->filename) }}"
                                class="users-avatar-shadow rounded-circle img-preview"  width="100%">
                        </a>
                    @else
                        <a class="mr-2" href="#">
                            <img src="{{ asset('Dashboard/img/admins/avatar.jpg') }}"
                            alt="{{ asset('Dashboard/img/admins/avatar.jpg') }}"
                            class="users-avatar-shadow rounded-circle img-preview"  width="100%">
                        </a>
                    @endif
                    <!-- end form -->

                    <div class="spacer py-6 d-md-none"></div>

                </div>

                <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">

                    <!-- start form -->
                    <p><b>@lang('Admin/site.name')  : </b> {{ $user->firstname }} {{ $user->lastname }}</p>
                    <p><b>@lang('Admin/site.email') : </b> {{ $user->email }}</p>
                    <p><b>@lang('Admin/site.phone') : </b> {{ $user->phone }}</p>
                    <p><b>@lang('Admin/site.birthday') : </b> {{ $user->birthdate }}</p>
                    <p><b>@lang('Admin/site.address1') : </b> {{ $user->address1 }}</p>
                    <p><b>@lang('Admin/site.address2') : </b> {{ $user->address2 }}</p>
                    <p><b>@lang('Admin/site.country') : </b> {{ $user->country->name }}</p>
                    <p><b>@lang('Admin/site.province') : </b> {{ $user->province->name }}</p>
                    <p><b>@lang('Admin/site.area') : </b> {{ $user->area->name }}</p>
                    <p><b>@lang('Admin/site.state') : </b> {{ $user->state->name }}</p>
                    <p><b>@lang('Admin/site.village') : </b> {{ $user->village->name }}</p>
                    <p><b>@lang('Admin/site.department') : </b> {{ $user->department->name }}</p>
                    <!-- end form -->
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
