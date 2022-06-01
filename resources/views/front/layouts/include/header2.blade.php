{{-- header2 for shop page --}}
<header id="top-bar" class="top-bar top-bar--style-2">
    <div class="top-bar__bg" style="background-color: #FFF;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-2.png') }});
    background-repeat: no-repeat;background-position: center bottom;"></div>

    <div class="container position-relative">
        <div class="row justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="index_4.html">
                @if(app()->getLocale()=='ar')
                    <img class="img-logo  img-fluid  lazy"
                         src="{{ setting()->ar_site_logo ?
                        URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ar.png')}}"
                         style="left: 45%;    width: 70px;height: 70px;"/>
                @elseif(app()->getLocale()=='ku')
                    <img class="img-logo  img-fluid  lazy"
                         src="{{setting()->ku_site_logo ?
                        URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ku.png')}}"
                         alt="" style="left: 45%;    width: 70px;height: 70px;"/>
                @elseif(app()->getLocale()=='en')
                    <img class="img-logo  img-fluid  lazy" src="{{setting()->en_site_logo ?
                         URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo) :
                         URL::asset('Dashboard/img/Default/logo_en.png')}}"
                         alt="" style="left: 45%;    width: 50px;height: 50px;"/>

                @endif
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--dark" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner  text-lg-right">
                <div>
                    <div class="d-lg-flex flex-lg-column-reverse align-items-lg-end">
                        <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                            @include('front.layouts.include.navbar')
                        </nav>

                        <div class="top-bar__contacts">
                            <span>{{ \App\Models\setting::first()->address }}</span>
                            {{-- <span>523 Sylvan Ave, 5th Floor Mountain View, CA 940 USA</span> --}}
                            <span><a href="#">{{  \App\Models\setting::first()->primary_phone }}</a>,&nbsp;&nbsp;
                                  <a href="#">{{  \App\Models\setting::first()->secondery_phone }}</a></span>
                            {{--<span><a href="#">{{  \App\Models\setting::first()->message_maintenance }}</a></span>--}}

                            <div class="social-btns">
                                <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                                <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                                <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
