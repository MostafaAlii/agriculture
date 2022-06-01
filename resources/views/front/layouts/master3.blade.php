<!DOCTYPE html>
<html class="no-js" lang="en">

	<head>
		@include('front.layouts.include.headcss')
	</head>

	<body>
		<div id="app">
			<!-- start header -->
			@include('front.layouts.include.header3')
			<!-- end header -->
			<?php
			$slider = \App\Models\Slider::latest()->first();
			if(isset($slider->image->filename)){
				$src=$slider->image->filename;
			}else{
				$src='100.jpg';
			}
			?>
			<!-- start hero -->
			<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%"
            style="background-image: url({{ asset('Dashboard/img/sliders/'.$src) }});">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-7">
							<h1 class="__title">{{ $slider->title }}</h1>
							<p>
                                 {{ $slider->subtitle }}
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- end hero -->

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

			<!-- start footer -->
			{{-- <footer id="footer" class="footer--style-1">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-auto">
							<div class="footer__item">
								<a class="site-logo" href="index.html">


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
							</div>
						</div>

						<div class="col-12 col-sm">
							<div class="row align-items-md-center no-gutters">
								<div class="col-12 col-md">
									<div class="footer__item">
                                        <address>
                                            <p>
                                                <span>{{ \App\Models\setting::first()->address }}</span>
                                            </p>

                                            <p>
                                                {{  \App\Models\setting::first()->primary_phone }},
                                                {{  \App\Models\setting::first()->secondery_phone }} <br>
                                                <a href="#">{{  \App\Models\setting::first()->message_maintenance }}</a>
                                            </p>
                                        </address>
									</div>
								</div>

								<div class="col-12 col-md-auto">
									<div class="footer__item">
									    <div class="social-btns">
                                            <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                                            <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                                            <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                                        </div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-5 col-xl-4 offset-xl-1">
							<div class="footer__item">
								<h5 class="h6">Get a newslatter</h5>

                                <form class="form--horizontal" method="post"  id="ajaxform">
                                    @csrf
                                    @method('post')
                                    <div class="input-wrp">
                                        <input class="textfield" name="email" type="email" placeholder="{{ __('Website/home.email') }}" />
                                    </div>
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1 save-data" type="submit" role="button">
                                        {{ __('Website/home.sub') }}
                                    </button>
								</form>
							</div>
						</div>
					</div>

					<div class="row flex-lg-row-reverse">
						<div class="col-12 col-lg-6">
							<div class="footer__item">
								<nav id="footer__navigation" class="navigation  text-lg-right">
									<ul>
										<li class="active"><a href="index.html">Home</a></li>
										<li><a href="#">About</a></li>
										<li><a href="#">Pages</a></li>
										<li><a href="#">Gallery</a></li>
										<li><a href="#">Blog</a></li>
										<li><a href="#">Contacts</a></li>
									</ul>
								</nav>
							</div>
						</div>

						<div class="col-12 col-lg-6">
							<div class="footer__item">
								<span class="__copy">© 2019 Agro. All rights reserved. Created by <a class="__dev" href="https://themeforest.net/user/artureanec" target="_blank">Artureanec</a></span>
							</div>
						</div>
					</div>
				</div>
			</footer> --}}

			<!-- end footer -->
		</div>

		<div id="btn-to-top-wrap">
			<a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
		</div>

        @include('front.layouts.include.footerjs')
	</body>
</html>
