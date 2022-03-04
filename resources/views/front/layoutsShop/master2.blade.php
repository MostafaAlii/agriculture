<!DOCTYPE html>
<html class="no-js" lang="en">

	<head>
        @include('front.layouts.headcss')
	</head>

	<body class="woocommerce-page catalog-page">
		<div id="app">
			<!-- start header -->

             @include('front.layoutsShop.header2')
			<!-- end header -->

			<!-- start hero -->
			<div id="hero" class="jarallax" data-speed="0.7" data-img-position="50% 80%" style="background-image: url(img/intro_img/12.jpg);color: #333;">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-7">
							<h1 class="__title"><span>Agro Shop</span> Catalog</h1>

							<p>
								The point of using is that it has a more-or-less normal distribution of letters, as opposed to using Content here content here making it look
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

				<!-- start section -->
				<section class="section">
					<div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
						<img class="lazy" width="286" height="280" src="img/blank.gif" data-src="img/decor-el_1.jpg" alt="demo"/>
					</div>

					<div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
						<img class="lazy" width="99" height="88" src="img/blank.gif" data-src="img/decor-el_2.jpg" alt="demo"/>
					</div>

					<div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
						<img class="lazy" width="115" height="117" src="img/blank.gif" data-src="img/decor-el_3.jpg" alt="demo"/>
					</div>

					<div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
						<img class="lazy" width="84" height="76" src="img/blank.gif" data-src="img/decor-el_4.jpg" alt="demo"/>
					</div>

					<div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
						<img class="lazy" width="248" height="309" src="img/blank.gif" data-src="img/decor-el_5.jpg" alt="demo"/>
					</div>

					<div class="container">

						<!-- start goods catalog -->
						<div class="goods-catalog">
							<div class="row">
								<div class="col-12 col-md-4 col-lg-3">
									<aside class="sidebar goods-filter">
										<span class="goods-filter-btn-close js-toggle-filter"><i class="fontello-cancel"></i></span>

										<div class="goods-filter__inner">
											<!-- start widget -->
											<div class="widget widget--search">
												<form class="form--horizontal" action="#" method="get">
													<div class="input-wrp">
														<input class="textfield" name="s" type="text" placeholder="Search" />
													</div>

													<button class="custom-btn custom-btn--tiny custom-btn--style-1" type="submit" role="button">Find</button>
												</form>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--categories">
												<h4 class="h6 widget-title">CAtegories</h4>

												<ul class="list">
													<li class="list__item">
														<a class="list__item__link" href="#">Apples</a>
														<span>(3)</span>
													</li>

													<li class="list__item">
														<a class="list__item__link" href="#">Oranges</a>
														<span>(5)</span>
													</li>

													<li class="list__item">
														<a class="list__item__link" href="#">Strawbery</a>
														<span>(2)</span>
													</li>

													<li class="list__item">
														<a class="list__item__link" href="#">Banana</a>
														<span>(8)</span>
													</li>

													<li class="list__item">
														<a class="list__item__link" href="#">Pumpkin </a>
														<span>(5)</span>
													</li>
												</ul>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--price">
												<h4 class="h6 widget-title">Price</h4>

												<div>
													<input type="text" class="js-range-slider" name="my_range" value=""
														data-type="double"
														data-min="0"
														data-max="500"
														data-from="48"
														data-to="365"
														data-grid="false"
														data-skin="round"
														data-prefix="$"
														data-hide-from-to="true"
														data-hide-min-max="true"
													/>

													<div class="row">
														<div class="col-6">
															<input class="range-slider-min-value" type="text" value="48" name="min-value" readonly="readonly">
														</div>

														<div class="col-6">
															<input class="range-slider-max-value" type="text" value="365" name="max-value" readonly="readonly">
														</div>
													</div>
												</div>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--additional">
												<h4 class="h6 widget-title">Additional</h4>

												<ul>
													<li>
														<label class="checkfield">
															<input type="checkbox" checked/>
															<i></i>
															Organic
														</label>
													</li>

													<li>
														<label class="checkfield">
															<input type="checkbox" />
															<i></i>
															Fresh
														</label>
													</li>

													<li>
														<label class="checkfield">
															<input type="checkbox" />
															<i></i>
															Sales
														</label>
													</li>

													<li>
														<label class="checkfield">
															<input type="checkbox" />
															<i></i>
															Discount
														</label>
													</li>

													<li>
														<label class="checkfield">
															<input type="checkbox" />
															<i></i>
															Expired
														</label>
													</li>
												</ul>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--tags">
												<h4 class="h6 widget-title">Popular Tags</h4>

												<ul>
													<li><a href="#">Art</a></li>
													<li><a href="#">design</a></li>
													<li><a href="#">concept</a></li>
													<li><a href="#">Media</a></li>
													<li><a href="#">Photography</a></li>
													<li><a href="#">UI</a></li>
												</ul>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget">
												<div class="row no-gutters align-items-center">
													<div class="col">
														<button class="custom-btn custom-btn--medium custom-btn--style-1" role="button">Show Products</button>
													</div>

													<div class="col-auto">
														<a class="clear-filter" href="#">Clear all</a>
													</div>
												</div>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--products">
												<h4 class="h6 widget-title">Featured products</h4>

												<ul>
													<li>
														<div class="row no-gutters">
															<div class="col-auto __image-wrap">
																<figure class="__image">
																	<a href="single_product.html">
																		<img class="lazy" src="img/blank.gif" data-src="img/goods_img/5.jpg" alt="demo" />
																	</a>
																</figure>
															</div>

															<div class="col">
																<h4 class="h6 __title"><a href="single_product.html">Big Banana</a></h4>

																<div class="rating">
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item"><i class="fontello-star"></i></span>
																</div>

																<div class="product-price">
																	<span class="product-price__item product-price__item--new">2.99 $</span>
																	<span class="product-price__item product-price__item--old">4.11 $</span>
																</div>
															</div>
														</div>
													</li>

													<li>
														<div class="row no-gutters">
															<div class="col-auto __image-wrap">
																<figure class="__image">
																	<a href="single_product.html">
																		<img class="lazy" src="img/blank.gif" data-src="img/goods_img/8.jpg" alt="demo" />
																	</a>
																</figure>
															</div>

															<div class="col">
																<h4 class="h6 __title"><a href="single_product.html">Awesome Peach </a></h4>

																<div class="rating">
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item"><i class="fontello-star"></i></span>
																</div>

																<div class="product-price">
																	<span class="product-price__item product-price__item--new">10.99 $</span>
																</div>
															</div>
														</div>
													</li>

													<li>
														<div class="row no-gutters">
															<div class="col-auto __image-wrap">
																<figure class="__image">
																	<a href="single_product.html">
																		<img class="lazy" src="img/blank.gif" data-src="img/goods_img/2.jpg" alt="demo" />
																	</a>
																</figure>
															</div>

															<div class="col">
																<h4 class="h6 __title"><a href="single_product.html">Awesome Brocoli</a></h4>

																<div class="rating">
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
																	<span class="rating__item"><i class="fontello-star"></i></span>
																</div>

																<div class="product-price">
																	<span class="product-price__item product-price__item--new">5.99 $</span>
																</div>
															</div>
														</div>
													</li>
												</ul>
											</div>
											<!-- end widget -->

											<!-- start widget -->
											<div class="widget widget--banner">
												<a href="#"><img class="img-fluid  lazy" src="img/blank.gif" data-src="img/widget_banner_2.jpg" alt="demo" /></a>
											</div>
											<!-- end widget -->
										</div>
									</aside>
								</div>

								<div class="col-12 col-md-8 col-lg-9">
									<div class="spacer py-6 d-md-none"></div>

									<div class="row align-items-center justify-content-between">
										<div class="col-auto">
											<span class="goods-filter-btn-open js-toggle-filter"><i class="fontello-filter"></i>Filter</span>
										</div>

										<div class="col-auto">
											<!-- start ordering -->
											<form class="ordering" action="#">
												<div class="input-wrp">
													<select class="textfield wide js-select">
														<option value="1">Default Sorting</option>
														<option value="2">Price. low to high</option>
														<option value="3">Price. high to low</option>
														<option value="3">Sort by latest</option>
													</select>
												</div>
											</form>
											<!-- end ordering -->
										</div>
									</div>

									<div class="spacer py-3"></div>

									<!-- start goods -->
									<div class="goods goods--style-1">
										<div class="__inner">
											<div class="row">
												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="188" src="img/blank.gif" data-src="img/goods_img/1.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Oranges</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">3,80 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--sale">Sale</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="180" src="img/blank.gif" data-src="img/goods_img/2.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Brocoli</a></h4>

															<div class="__category"><a href="#">Vegetables</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">3,35 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--new">New</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="160" src="img/blank.gif" data-src="img/goods_img/3.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Red Apple</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">0,99 $</span>
																<span class="product-price__item product-price__item--old">2200$</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--hot">hot</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="190" src="img/blank.gif" data-src="img/goods_img/4.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Strawberry</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">2,10 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--sale">Sale</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="180" src="img/blank.gif" data-src="img/goods_img/5.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Fresh Banana</a></h4>

															<div class="__category"><a href="#">Vegetables</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">10,99 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--new">New</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="180" src="img/blank.gif" data-src="img/goods_img/6.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Big Pumpkin</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">8,15 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--hot">hot</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="250" src="img/blank.gif" data-src="img/goods_img/7.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Organic Tomato</a></h4>

															<div class="__category"><a href="#">Vegetables</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--old">6,68 $</span>
																<span class="product-price__item product-price__item--new">6,12 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="236" src="img/blank.gif" data-src="img/goods_img/8.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Organic Peach</a></h4>

															<div class="__category"><a href="#">Vegetables</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--old">6,68 $</span>
																<span class="product-price__item product-price__item--new">6,12 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="188" src="img/blank.gif" data-src="img/goods_img/1.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Oranges</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">3,80 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--sale">Sale</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="180" src="img/blank.gif" data-src="img/goods_img/2.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Brocoli</a></h4>

															<div class="__category"><a href="#">Vegetables</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">3,35 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--new">New</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="160" src="img/blank.gif" data-src="img/goods_img/3.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Red Apple</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">0,99 $</span>
																<span class="product-price__item product-price__item--old">2200$</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--hot">hot</span>
													</div>
												</div>
												<!-- end item -->

												<!-- start item -->
												<div class="col-12 col-sm-6 col-lg-4">
													<div class="__item">
														<figure class="__image">
															<img class="lazy" width="190" src="img/blank.gif" data-src="img/goods_img/4.jpg" alt="demo" />
														</figure>

														<div class="__content">
															<h4 class="h6 __title"><a href="single_product.html">Strawberry</a></h4>

															<div class="__category"><a href="#">Fruits</a></div>

															<div class="product-price">
																<span class="product-price__item product-price__item--new">2,10 $</span>
															</div>

															<a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
														</div>

														<span class="product-label product-label--sale">Sale</span>
													</div>
												</div>
												<!-- end item -->
											</div>
										</div>
									</div>
									<!-- end goods -->

									<div class="spacer py-5"></div>

									<!-- start pagination -->
									<nav aria-label="Page navigation example">
										<ul class="pagination justify-content-center">
											<li class="page-item"><a class="page-link" href="#">1</a></li>
											<li class="page-item active"><a class="page-link" href="#">2</a></li>
											<li class="page-item"><a class="page-link" href="#">3</a></li>
											<li class="page-item"><a class="page-link" href="#">4</a></li>
											<li class="page-item"><a class="page-link" href="#"><i class="fontello-angle-right"></i></a></li>
										</ul>
									</nav>
									<!-- end pagination -->
								</div>
							</div>
						</div>
						<!-- end goods catalog -->

					</div>
				</section>
				<!-- end section -->

				<!-- start section -->
				<section class="section section--no-pt section--no-pb section--gutter">
					<div class="container-fluid px-md-0">
						<!-- start banner simple -->
						<div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
							<div class="d-none d-lg-block">
								<img class="img-logo img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
							</div>

							<div class="row no-gutters">
								<div class="col-12 col-lg-6">
									<a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_3.jpg" alt="demo" /></a>
								</div>

								<div class="col-12 col-lg-6">
									<a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_4.jpg" alt="demo" /></a>
								</div>
							</div>
						</div>
						<!-- end banner simple -->
					</div>
				</section>
				<!-- end section -->
			</main>
			<!-- end main -->

			<!-- start footer -->
			<footer id="footer" class="footer footer--style-4">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-4 col-md-3 col-lg-2">
							<div class="footer__item">
								<a class="site-logo" href="index.html">
									<img class="img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
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
										523 Sylvan Ave, 5th Floor Mountain View, CA 940 USA
									</p>

									<p>
										+1 (234) 56789,  +1 987 654 3210
									</p>

									<p>
										<a href="mailto:support@agrocompany.com">support@agrocompany.com</a>
									</p>
								</address>

								<div class="social-btns">
									<a href="#"><i class="fontello-twitter"></i></a>
									<a href="#"><i class="fontello-facebook"></i></a>
									<a href="#"><i class="fontello-linkedin-squared"></i></a>
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

        @include('front.layouts.footerjs')
	</body>
</html>
