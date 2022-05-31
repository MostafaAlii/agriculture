<header id="top-bar" class="top-bar top-bar--style-1">
    <div class="top-bar__bg" style="background-color: #24292c;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-1.jpg') }});
    background-repeat: no-repeat;background-position: left bottom;"></div>

    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="index.html">
                @if(app()->getLocale()=='ar')
                    <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}"
                         data-src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}" width="70" height="70"
                         alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                @else
                    <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}"
                         data-src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}" width="70" height="70"
                         alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                @endif
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--light" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner">
                <div>
                    <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                      @include('front.layouts.include.navbar')
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>
