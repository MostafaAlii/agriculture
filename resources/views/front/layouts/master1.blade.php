<!DOCTYPE html>
<html class="no-js" lang="en">

	<head>
        @include('front.layouts.include.headcss')
	</head>

	<body class="woocommerce-page shop-home-page">
		<div id="app">
			<!-- start header -->
			@include('front.layouts.include.header1')
			<!-- end header -->

			<!-- start start screen slider -->
			<div
				id="start-screen"
				class="start-screen start-screen--style-4 js-slick"
				data-slick='{
					"autoplay": true,
					"fade": true,
					"speed": 1200,
					"arrows": true,
					"dots": false
				}'>
                @foreach (\App\Models\Slider::get() as $slider)
					<?php if(isset($slider->image->filename)){$scr=$slider->image->filename;}else{$scr="";}?>



                    <div class="start-screen__slide">
                        <div class="start-screen__bg"
                        style="background-image: url({{ asset('Dashboard/img/sliders/'. $scr) }});
                        background-position: top 30% right 30%;"></div>
                        <div class="start-screen__content__item align-items-center">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-sm-10 col-md-9 col-lg-9 col-xl-8">
                                        <h3 class="__title" style="color:#fff;">
                                            {{ $slider->title }}
                                        </h3>
                                        <h4 style="background-color:rgb(169, 202, 20)">{{ $slider->subtitle }}</h4>
                                        <p>
                                            <span class="d-none d-sm-block">
                                                <a class="custom-btn custom-btn--big custom-btn--style-1" href="#">
                                                    Discover
                                                </a>
                                            </span>
                                            <span class="d-block d-sm-none" >
                                                <a class="custom-btn custom-btn--small custom-btn--style-1" href="#" >
                                                    Discover
                                                </a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
			</div>
			<!-- end start screen -->

			<!-- start main -->
			<main role="main">
				<!-- Common styles
				================================================== -->
                @if(app()->getLocale()=='ar')
                <link rel="stylesheet" href="{{ asset('frontassets/css/style-ar.css') }}" type="text/css">
                @elseif(app()->getLocale()=='ku')
                 <link rel="stylesheet" href="{{ asset('frontassets/css/style-ar.css') }}" type="text/css">
                @else
                {{-- <link rel="stylesheet" href="{{ asset('frontassets/css/style.min.css') }}" type="text/css"> --}}
                <link rel="stylesheet" href="{{ asset('frontassets/css/style.css') }}" type="text/css">
                @endif

				<!-- Load lazyLoad scripts
				================================================== -->
				<script>
					(function(w, d){
						var m = d.getElementsByTagName('main')[0],
							s = d.createElement("script"),
							v = !("IntersectionObserver" in w) ? "8.17.0" : "10.19.0",
							o = {
								elements_selector: ".lazy",
								data_src: 'src',
								data_srcset: 'srcset',
								threshold: 500,
								callback_enter: function (element) {

								},
								callback_load: function (element) {
									element.removeAttribute('data-src')

									oTimeout = setTimeout(function ()
									{
										clearTimeout(oTimeout);

										AOS.refresh();
									}, 1000);
								},
								callback_set: function (element) {

								},
								callback_error: function(element) {
									element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";
								}
							};
						s.type = 'text/javascript';
						s.async = true; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
						s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
						m.appendChild(s);
						// m.insertBefore(s, m.firstChild);
						w.lazyLoadOptions = o;
					}(window, document));
				</script>

             {{ $slot }}
			</main>
			<!-- end main -->

			@include('front.layouts.include.footer')
		</div>

        @include('front.layouts.include.footerjs')
	</body>
</html>
