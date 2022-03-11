<header id="top-bar" class="top-bar top-bar--style-1">
    <div class="top-bar__bg" style="background-color: #24292c;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-1.jpg') }});
    background-repeat: no-repeat;background-position: left bottom;"></div>

    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="index.html">
                <img class="img-fluid" src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />
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
