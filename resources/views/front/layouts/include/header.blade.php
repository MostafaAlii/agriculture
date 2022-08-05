<header id="top-bar" class="top-bar top-bar--style-1">
    <div class="top-bar__bg" style="background-color: #24292c;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-1.jpg') }});
    background-repeat: no-repeat;background-position: left bottom;"></div>

    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="#">
                @if(app()->getLocale()=='ar')
                    <img class="img-logo  img-fluid  lazy"
                         src="{{ setting()->ar_site_logo ?
                        URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ar.png')}}"  alt=""
                         style="left: 45%;   width: 100px;height: 110px;  "/>
                @elseif(app()->getLocale()=='ku')
                    <img class="img-logo  img-fluid  lazy"
                         src="{{setting()->ku_site_logo ?
                        URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ku.png')}}"
                         alt="" style="left: 45%;    width: 100px; height: 110px;"/>
                @elseif(app()->getLocale()=='en')
                    <img class="img-logo  img-fluid  lazy" src="{{setting()->en_site_logo ?
                         URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo) :
                         URL::asset('Dashboard/img/Default/logo_en.png')}}"
                         alt="" style="left: 45%;    width: 100px;height: 110px;"/>

                @endif
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--light" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner">
                <div>
                    <div class="top-bar__contacts">
                        <span>{{ \App\Models\setting::first()->address }}</span>
                        {{-- <span>523 Sylvan Ave, 5th Floor Mountain View, CA 940 USA</span> --}}
                        <span><a href="#">{{  \App\Models\setting::first()->primary_phone }}</a>,&nbsp;&nbsp;
                              <a href="#">{{  \App\Models\setting::first()->secondery_phone }}</a></span>


                        <div class="social-btns">
                            <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                            <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                            <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                        </div>
                    </div>
                    <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                      @include('front.layouts.include.navbar')
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>
