@section('title', __('website\home.my_profile'))
@section('css')

@endsection
<style>
    .score {
  display: inline-block;
  font-family: Wingdings;
  font-size: 30px;
  color: #ccc;
  position: relative;
}
.score::before,
.score span::before{
  content: "\2605\2605\2605\2605\2605";
  display: block;
}
.score span {
  color: gold;
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
}
</style>
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

                    <!-- start form -->
                    @if($farmer->image)
                        <a class="mr-2" href="#">
                                <img src="{{ asset('Dashboard/img/farmers/'. $farmer->image->filename) }}"
                                alt="{{ __('Admin/site.no-image') }}"
                                class="users-avatar-shadow rounded-circle img-preview"  width="100%">
                        </a>
                    @else
                        <a class="mr-2" href="#">
                            <img src="{{ asset('Dashboard/img/profile.png') }}"
                            alt="{{ __('Admin/site.no-image') }}"
                            class="users-avatar-shadow rounded-circle img-preview"  width="100%">
                        </a>
                    @endif
                    <!-- end form -->
                    <center> <span class="score" id="rate_msg" ><span style="width: <?php echo $farmer->farmerRate();?>%"></span></span></center>

                    <div class="spacer py-6 d-md-none"></div>

                </div>

                <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">

                    <!-- start form -->
                    <p><b>@lang('Admin/site.name')  : </b> {{ $farmer->firstname }} {{ $farmer->lastname }}</p>
                    <p><b>@lang('Admin/site.email') : </b> {{ $farmer->email }}</p>
                    <p><b>@lang('Admin/site.phonenum') : </b> {{ $farmer->phone }}</p>
                    {{-- <p><b>@lang('Admin/site.birthday') : </b> {{ $farmer->birthdate }}</p>
                    <p><b>@lang('Admin/site.address1') : </b> {{ $farmer->address1 ?? null}}</p>
                    <p><b>@lang('Admin/site.address2') : </b> {{ $farmer->address2 ?? null}}</p>
                    <p><b>@lang('Admin/site.country') : </b> {{ $farmer->country->name ?? null}}</p>
                    <p><b>@lang('Admin/site.province') : </b> {{ $farmer->province->name ?? null}}</p>
                    <p><b>@lang('Admin/site.area') : </b> {{ $farmer->area->name ?? null}}</p>
                    <p><b>@lang('Admin/site.state') : </b> {{ $farmer->state->name ?? null}}</p>
                    <p><b>@lang('Admin/site.village') : </b> {{ $farmer->village->name ?? null}}</p>
                    <p><b>@lang('Admin/site.department') : </b> {{ $farmer->department->name ?? null}}</p> --}}
                    <!-- end form -->
                    <a href="{{ route('farmer.ownprofile.edit') }}"
                    class="custom-btn custom-btn--medium custom-btn--style-1"
                    >{{ __('Admin/site.edit') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

