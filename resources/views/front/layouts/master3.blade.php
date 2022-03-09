<!DOCTYPE html>
<html class="no-js" lang="en">

	<head>
		@include('front.layouts.headcss')
	</head>

	<body>
		<div id="app">
			<!-- start header -->
			@include('front.layouts.header3')
			<!-- end header -->

			<!-- start hero -->
			<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url({{ URL::asset('frontassets/img/intro_img/1.jpg') }});">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-7">
							<h1 class="__title"><span>About</span> company</h1>
							<p>
								The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English
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
			<footer id="footer" class="footer--style-1">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-auto">
							<div class="footer__item">
								<a class="site-logo" href="index.html">
									<img class="img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
								</a>
							</div>
						</div>

						<div class="col-12 col-sm">
							<div class="row align-items-md-center no-gutters">
								<div class="col-12 col-md">
									<div class="footer__item">
										<address>
											<p>
												523 Sylvan Ave, 5th Floor Mountain View, CA 94041USA
											</p>

											<p>
												+1 (234) 56789,  +1 987 654 3210 <br>
												<a href="mailto:support@agrocompany.com">support@agrocompany.com</a>
											</p>
										</address>
									</div>
								</div>

								<div class="col-12 col-md-auto">
									<div class="footer__item">
										<div class="social-btns">
											<a href="#"><i class="fontello-twitter"></i></a>
											<a href="#"><i class="fontello-facebook"></i></a>
											<a href="#"><i class="fontello-linkedin-squared"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-5 col-xl-4 offset-xl-1">
							<div class="footer__item">
								<h5 class="h6">Get a newslatter</h5>

								<form class="form--horizontal" action="#">
									<div class="input-wrp">
										<input class="textfield" name="s" type="text" placeholder="Your E-mail" />
									</div>

									<button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">subscribe</button>
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
			</footer>
			<!-- end footer -->
		</div>

		<div id="btn-to-top-wrap">
			<a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
		</div>

        @include('front.layouts.footerjs')
	</body>
</html>
