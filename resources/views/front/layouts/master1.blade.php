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
				<div class="start-screen__slide">
					<div class="start-screen__bg" style="background-image: url({{ URL::asset('frontassets/img/home_img/img_7.jpg') }});background-position: top 30% right 30%;"></div>
					<div class="start-screen__content__item align-items-center">
						<div class="container">
							<div class="row">

								<div class="col-12 col-sm-10 col-md-9 col-lg-9 col-xl-8">
									<h2 class="__title"><span>Get the</span> Fresh Food <span>from our</span> Agro Market</h2>

									<p>
										<span class="d-none d-sm-block"><a class="custom-btn custom-btn--big custom-btn--style-1" href="#">Discover</a></span>
										<span class="d-block d-sm-none"><a class="custom-btn custom-btn--small custom-btn--style-1" href="#">Discover</a></span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="start-screen__slide">
					<div class="start-screen__bg" style="background-image: url({{ URL::asset('frontassets/img/home_img/img_8.jpg') }});background-position: top 30% left 70%;"></div>

					<div class="start-screen__content__item align-items-center">
						<div class="container">
							<div class="row justify-content-end">
								<div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7">
									<h2 class="__title"><span>Awesome</span> Organic Cosmetic <span>from Agro</span></h2>

									<p>
										Bitterling duckbilled barracudina New Zealand sand diver, "oldwife sarcastic fringehead sea toad bighead carp sculpin tadpole fish creek chub." Dottyback sand
									</p>

									<p class="mt-5 mt-md-8">
										<span class="d-none d-sm-block"><a class="custom-btn custom-btn--big custom-btn--style-2" href="#">Discover</a></span>
										<span class="d-block d-sm-none"><a class="custom-btn custom-btn--small custom-btn--style-2" href="#">Discover</a></span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="start-screen__slide">
					<div class="start-screen__bg" style="background-image: url({{ URL::asset('frontassets/img/home_img/img_9.jpg') }});"></div>

					<div class="start-screen__content__item align-items-center">
						<div class="container">
							<div class="row justify-content-center text-center">
								<div class="col-12 col-md-9 col-lg-8 col-xl-7">
									<h2 class="__title text-white"><span>Fresh</span> Blueberries & Citrus <span>from Agro</span></h2>

									<p class="text-white">
										Bitterling duckbilled barracudina New Zealand sand diver, "oldwife sarcastic fringehead sea toad bighead carp sculpin tadpole fish creek chub." Dottyback sand goby
									</p>

									<p class="mt-5 mt-md-8">
										<span class="d-none d-sm-block"><a class="custom-btn custom-btn--big custom-btn--style-3" href="#">Discover</a></span>
										<span class="d-block d-sm-none"><a class="custom-btn custom-btn--small custom-btn--style-3" href="#">Discover</a></span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end start screen -->

			<!-- start main -->
			<main role="main">
				<!-- Common styles
				================================================== -->
				<link rel="stylesheet" href="{{ asset('frontassets/css/style.min.css') }}" type="text/css">

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
			<footer id="footer" class="footer footer--style-4">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-4 col-md-3 col-lg-2">
							<div class="footer__item">
								<a class="site-logo" href="index.html">
									{{--<img class="img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />--}}
									<img class="img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingLogo/'.setting()->site_logo)}}" data-src="{{URL::asset('Dashboard/img/settingLogo/'.setting()->site_logo)}}" alt="demo" />
								</a>
							</div>
						</div>

						<div class="col-12 col-md-9 col-lg-6">
							<div class="footer__item">
								<nav id="footer__navigation" class="navigation">
									<div class="row">
										<div class="col-6 col-sm-4">
											<h5 class="footer__item__title h6">Menu</h5>

											<ul>
												<li class="active"><a href="index.html">Home</a></li>
												<li><a href="#">About</a></li>
												<li><a href="#">Pages</a></li>
												<li><a href="#">Gallery</a></li>
												<li><a href="#">Blog</a></li>
												<li><a href="#">Contacts</a></li>
											</ul>
										</div>

										<div class="col-6 col-sm-4">
											<h5 class="footer__item__title h6">Shop</h5>

											<ul>
												<li><a href="#">Partners</a></li>
												<li><a href="#">Customer Service</a></li>
												<li><a href="#">Vegetables</a></li>
												<li><a href="#">Fruits</a></li>
												<li><a href="#">Organic Food</a></li>
												<li><a href="#">Privacy policy</a></li>
											</ul>
										</div>

										<div class="col-6 col-sm-4">
											<h5 class="footer__item__title h6">Information</h5>

											<ul>
												<li><a href="#">Delivery</a></li>
												<li><a href="#">Legal Notice</a></li>
												<li><a href="#">About Us</a></li>
												<li><a href="#">Secure Payment</a></li>
												<li><a href="#">Prices Drop</a></li>
												<li><a href="#">Documents</a></li>
											</ul>
										</div>
									</div>
								</nav>
							</div>
						</div>

						<div class="col-12 col-md col-lg-4">
							<div class="footer__item">
								<h5 class="footer__item__title h6">Contacts</h5>

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

                                <div class="social-btns">
                                    <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                                    <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                                    <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                                </div>
							</div>
						</div>
					</div>

					<div class="row align-items-lg-end justify-content-lg-between copyright">
						<div class="col-12 col-lg-6">
							<div class="footer__item">
								<span class="__copy">© 2019, AgroTheme by <a class="__dev" href="https://themeforest.net/user/artureanec" target="_blank">Artureanec</a> | <a href="#">Privacy Policy</a> | <a href="#">Sitemap</a></span>
							</div>
						</div>

						<div class="col-12 col-lg-6">
							<div class="footer__item">
								<form class="form--horizontal no-gutters" action="#">
									<div class="col-sm-6">
										<div class="input-wrp">
											<input class="textfield" name="s" type="text" placeholder="Your E-mail" />
										</div>
									</div>

									<div class="col-sm-6">
										<button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">subscribe</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- end footer -->
		</div>

        @include('front.layouts.include.footerjs')
	</body>
</html>
