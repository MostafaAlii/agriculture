<!DOCTYPE html>
{{-- <html class="no-js" lang="en" oncontextmenu="return false"> --}}
    <html class="no-js" lang="en" >

	<head>
        @include('front.layouts.include.headcss')

	</head>

	<body class="woocommerce-page catalog-page">
		<div id="app">
			<!-- start header -->

             @include('front.layouts.include.header2')
			<!-- end header -->

			<!-- start hero -->
			<?php
			$slider = Slider::latest()->first();
			if(isset($slider->image_path)){
				$src=$slider->image_path;
			}else{
				$src= asset('Dashboard/img/Default/default_slider.jpg');
			}
			?>
			<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%"
                 style="background-image: url({{ $src }});
                        color: #333;">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-7">
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

		        @include('front.layouts.include.footer')

		</div>

        @include('front.layouts.include.footerjs')
	</body>
</html>
