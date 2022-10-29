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
            @include('dashboard.common._partials.messages')
            @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                <strong style="padding-right: 35px;">{{ session()->get('message') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                    <h2>@lang('website\home.my_profile')</h2>
                    <img class="mr-2 users-avatar-shadow rounded-circle img-preview" width="85%" src=" {{ $user->image_path ?
                        $user->image_path : URL::asset('Dashboard/img/Default/default_vendor.jpg') }}"
                        alt="{{ $user->firstname . ' ' .$user->lastname }}">
                    <!-- end form -->

                    <div class="spacer py-6 d-md-none"></div>

                </div>

                <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">

                    <!-- start form -->
                    <p><b>@lang('Admin/site.name')  : </b> {{ $user->firstname }} {{ $user->lastname }}</p>
                    <p><b>@lang('Admin/site.email') : </b> {{ $user->email }}</p>
                    <p><b>@lang('Admin/site.phonenum') : </b> {{ $user->phone }}</p>
                    <p><b>@lang('Admin/site.birthday') : </b> {{ $user->birthdate }}</p>
                    <p><b>@lang('Admin/site.address1') : </b> {{ $user->address1 }}</p>
                    <p><b>@lang('Admin/site.address2') : </b> {{ $user->address2 }}</p>
                    <p><b>@lang('Admin/site.country') : </b> {{ $user->country->name ??null}}</p>
                    <p><b>@lang('Admin/site.province') : </b> {{ $user->province->name ??null}}</p>
                    <p><b>@lang('Admin/site.area') : </b> {{ $user->area->name ??null}}</p>
                    <p><b>@lang('Admin/site.state') : </b> {{ $user->state->name ??null}}</p>
                    <p><b>@lang('Admin/site.village') : </b> {{ $user->village->name ??null}}</p>
                    <p><b>@lang('Admin/site.department') : </b> {{ $user->department->name ??null}}</p>
                    <!-- end form -->
                    <a href="{{ route('user.editownprofile') }}"
                    class="custom-btn custom-btn--medium custom-btn--style-1"
                    >{{ __('Admin/site.edit') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
