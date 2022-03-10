{{-- header2 for shop page --}}
<header id="top-bar" class="top-bar top-bar--style-2">
    <div class="top-bar__bg" style="background-color: #FFF;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-2.png') }});
    background-repeat: no-repeat;background-position: center bottom;"></div>

    <div class="container position-relative">
        <div class="row justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="index_4.html">
                <img class="img-fluid" src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--dark" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner  text-lg-right">
                <div>
                    <div class="d-lg-flex flex-lg-column-reverse align-items-lg-end">
                        <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                            @include('front.layouts.navbar')
                        </nav>

                        <div class="top-bar__contacts">
                            <span>523 Sylvan Ave, 5th Floor Mountain View, CA 940 USA</span>
                            <span><a href="#">+1 (234) 56789</a>,&nbsp;&nbsp;<a href="#">+1 987 654 3210</a></span>
                            <span><a href="mailto:support@agrocompany.com">support@agrocompany.com</a></span>

                            <div class="social-btns">
                                <a class="fontello-twitter" href="#"></a>
                                <a class="fontello-facebook" href="#"></a>
                                <a class="fontello-linkedin-squared" href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
