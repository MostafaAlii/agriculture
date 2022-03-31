<div>
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
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-9">

                        <!-- start product single -->
                        <div class="product-single">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <div class="__product-img">

                                        @if($product->image->filename)
                                        <img width="330" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                        @else
                                        <img width="330" src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                        @endif
                                        <span class="product-label product-label--new">New</span>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="content-container">
                                        <h3 class="__name">{{ $product->name }}</h3>

                                        <div class="__categories">
                                            Category:
                                            <span>Vegetables</span>
                                        </div>

                                        <div class="product-price">
                                            <span class="product-price__item product-price__item--new">3,35 $</span>
                                        </div>

                                        <div class="rating">
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item"><i class="fontello-star"></i></span>
                                        </div>

                                        <p>
                                            The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                        </p>

                                        <p>
                                            Susp endisse ultricies nisi vel quam suscipit. Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish
                                        </p>

                                        <form class="__add-to-cart" action="#">
                                            <div class="quantity-counter js-quantity-counter">
                                                <span class="__btn __btn--minus"></span>
                                                <input class="__q-input" type="text" value="1" />
                                                <span class="__btn __btn--plus"></span>
                                            </div>

                                            <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button"><i class="fontello-shopping-bag"></i>Add to Cart</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="spacer py-5 py-md-9"></div>

                                    <!-- start tab -->
                                    <div class="tab-container">
                                        <nav class="tab-nav">
                                            <a href="#">Description</a>
                                            <a href="#">Reviews</a>
                                        </nav>

                                        <div class="tab-content">
                                            <div class="tab-content__item is-visible">
                                                <p>
                                                    The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit
                                                </p>

                                                <p>
                                                    Sabertooth peacock flounder; chain pickerel hatchetfish, pencilfish snailfish filefish Antarctic icefish goldeye aholehole trumpetfish pilot fish airbreathing catfish, electric ray sweeper.
                                                </p>

                                                <div class="description-table" style="max-width: 370px;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Weight</td>
                                                                <td>1 kg</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Country of Origin</td>
                                                                <td>Agro Farm</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Quality</td>
                                                                <td>Organic</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Сheck</td>
                                                                <td>Healthy</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Min Weight</td>
                                                                <td>250 Kg</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="tab-content__item">
                                                <!-- start comments list -->
                                                <ul class="comments-list">
                                                    <li class="comment">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-none d-lg-block">

                                                                        <div class="comment__author-img">
                                                                            <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                        </div>

                                                                    </div>
                                                                </td>

                                                                <td width="100%">
                                                                    <time class="comment__date-post">April 12, 2017</time>

                                                                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                                        <div class="d-block d-lg-none">

                                                                            <div class="comment__author-img">
                                                                                <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                            </div>

                                                                        </div>

                                                                        <span class="comment__author-name">Jason Smith</span>

                                                                        <div class="rating  d-none d-sm-block">
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item"><i class="fontello-star"></i></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="rating  mb-2 d-sm-none">
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item"><i class="fontello-star"></i></span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <p>
                                                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </li>

                                                    <li class="comment">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-none d-lg-block">

                                                                        <div class="comment__author-img">
                                                                            <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                        </div>

                                                                    </div>
                                                                </td>

                                                                <td width="100%">
                                                                    <time class="comment__date-post">April 12, 2017</time>

                                                                    <div class="d-flex align-items-center mb-3 mb-lg-0">
                                                                        <div class="d-block d-lg-none">

                                                                            <div class="comment__author-img">
                                                                                <img class="img-fluid lazy" width="70" src="img/blank.gif" data-src="img/avatar.jpg" alt="demo" />
                                                                            </div>

                                                                        </div>

                                                                        <span class="comment__author-name">Sam Peters</span>

                                                                        <div class="rating  d-none d-sm-block">
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item"><i class="fontello-star"></i></span>
                                                                            <span class="rating__item"><i class="fontello-star"></i></span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="rating  mb-2 d-sm-none">
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item"><i class="fontello-star"></i></span>
                                                                        <span class="rating__item"><i class="fontello-star"></i></span>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td></td>
                                                                <td>
                                                                    <p>
                                                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc. Susp endisse ultricies nisi vel quam suscipit. Molly Miller nurseryfish Rasbora, pearleye. Lefteye flounder, whale shark angler telescopefish remora mora pelican gulper lake whitefish whale shark
                                                                    </p>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </li>
                                                </ul>
                                                <!-- end comments list -->

                                                <!-- start add review -->
                                                <div class="__add-review">
                                                    <h5>Leave a Reply</h5>

                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="input-wrp">
                                                                    <input class="textfield" type="text" value="" placeholder="Name *" />
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-6">
                                                                <div class="input-wrp">
                                                                    <input class="textfield" type="text" value="" placeholder="Email *" inputmode="email" x-inputmode="email" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="input-wrp">
                                                            <textarea class="textfield" placeholder="Your review *"></textarea>
                                                        </div>

                                                        <div class="spacer py-md-5"></div>

                                                        <div class="row align-items-sm-center justify-content-sm-between">
                                                            <div class="col-12 col-sm-auto">
                                                                <fieldset class="rating">
                                                                    <span class="__note">Please rate:</span>

                                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                                    <label class="rating__item" for="star5" title="Awesome - 5 stars"><i class="fontello-star"></i></label>

                                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                                    <label class="rating__item" for="star4" title="Pretty good - 4 stars"><i class="fontello-star"></i></label>

                                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                                    <label class="rating__item" for="star3" title="Meh - 3 stars"><i class="fontello-star"></i></label>

                                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                                    <label class="rating__item" for="star2" title="Kinda bad - 2 stars"><i class="fontello-star"></i></label>

                                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                                    <label class="rating__item" for="star1" title="Sucks big time - 1 star"><i class="fontello-star"></i></label>
                                                                </fieldset>
                                                            </div>

                                                            <div class="col-12 col-sm-auto">
                                                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">post comment</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- end add review -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab -->

                                    <div class="spacer py-5 py-md-9"></div>
                                </div>
                            </div>
                        </div>
                        <!-- start product single -->

                        <h2>Related <span>products</span></h2>
                        <div class="spacer py-2"></div>

                        <!-- start goods -->
                        <div class="goods goods--style-1">
                            <div class="__inner">
                                <div class="row">
                                    <!-- start item -->
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="__item">
                                            <figure class="__image">
                                                <img class="lazy" width="180" src="img/blank.gif" data-src="img/goods_img/2.jpg" alt="demo" />
                                            </figure>

                                            <div class="__content">
                                                <h4 class="h6 __title"><a href="#">Brocoli</a></h4>

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
                                                <h4 class="h6 __title"><a href="#">Red Apple</a></h4>

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
                                                <h4 class="h6 __title"><a href="#">Strawberry</a></h4>

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

                    </div>

                    <div class="col-12 my-6 d-md-none"></div>

                    <div class="col-12 col-md-4 col-lg-3">
                        <aside class="sidebar">
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
                                <h4 class="h6 widget-title">{{ __('Admin/categories.departmentPageTitle') }}</h4>

                                <ul class="list">
                                    @foreach (\App\Models\Category::get() as $cat)
                                    <li class="list__item">
                                        <a class="list__item__link" href="#">{{ $cat->name }}</a>
                                        <span>(3)</span>
                                    </li>
                                @endforeach

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
                        </aside>
                    </div>
                </div>
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
	{{-- <!-- start section -->
    <section class="section section--gray-bg">
        <div class="container">
            <div class="simple-text-block">
                <div class="row justify-content-lg-center row--lg-middle">
                    <div class="col-lg-10">

                        <h2>About <span>Bolgarian Tomatos</span></h2>

                        <div class="row justify-content-lg-between no-gutters">
                            <div class="col-12 col-lg-6">
                                <p>
                                    Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite. <br> We believe in helping brands create through strategy, <a href="#">story-telling, digital products</a>, and integrated experiences on web, mobile, and in the world. friends, because you also believe.
                                </p>

                                <p>
                                    Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites.
                                </p>

                                <p>
                                    Stimulates vast a real proven works discount secure care. Market invigorate a awesome handcrafted bigger comes newer recommended lifetime.Evulates vast a real proven works discount secure care. Market invigorate a awesome handcrafted bigger comes newer recommended lifetime. Odor to yummy high racy.
                                </p>
                            </div>

                            <div class="col-12 my-3 d-lg-none"></div>

                            <div class="col-12 col-lg-5">
                                @if($product->image->filename)
                                    <img class="img-fluid  lazy" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                    data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                @else
                                    <img class="img-fluid  lazy" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                    data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                @endif
                            </div>
                        </div>

                        <div class="product-description">
                            <div class="my-5">
                                <div class="__title">CULTURE</div>
                                <div class="__name">{{ $product->name }}</div>
                            </div>

                            <div class="__details">
                                <div class="__details__inner">
                                    <div class="row">
                                        <div class="col-12 col-sm-auto">
                                            <div class="__details__item">
                                                <span class="__num">3500</span>
                                                <div class="__title">THE NUMBER OF HECTARES</div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-auto">
                                            <div class="__details__item">
                                                <span class="__num">236</span>
                                                <div class="__title">AMOUNT OF WORKERS</div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-auto">
                                            <div class="__details__item">
                                                <span class="__num">33 800</span>
                                                <div class="__title"> COLLECTED TONS</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section">
        <div class="container-fluid">
            <div class="product-features">
                <!-- start item -->
                <div class="__item">
                    <div class="__inner">
                        <div class="row justify-content-sm-center">
                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__content">
                                    <h3 class="__title">BETTER <span>THAN ORGANIC</span></h3>

                                    <div>
                                        <p>
                                            Evulates vast a real proven works discount secure care. Market invigorate a awesome handcrafted bigger comes newer recommended lifetime. Odor to yummy high racy bonus soaking mouthwatering. First superior full-bodied drink. Like outstanding odor economical deal clinically. Odor to yummy high racy bonus soaking mouthwatering. First superior full-bodied drink. Like outstanding odor economical deal clinically feel durable. Lather each real. Quite one fresh.
                                        </p>

                                        <p>
                                            Delectable absorbent ordinary full-bodied out durable whopping value when. Coming supreme tropical dual locked-in sharpest effervescent zesty bigger. Opportunity and affordable clinically. Ordinary whenever appearance first first unlimited compact.
                                        </p>

                                        <p>
                                            Effervescent pleasing touch vinyl choice. This artificial world's exotic. Survey is and. Delicious magically great product fat-free remarkable gigantic mild too herbal families creamy. Pay limited generous lasting millions sensible hurry pennies is out why sensible.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__image">
                                    <img class="img-fluid lazy" src="img/blank.gif" data-src="img/product-features_img/1.jpg" alt="demo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end item -->

                <!-- start item -->
                <div class="__item">
                    <div class="__inner">
                        <div class="row justify-content-sm-center">
                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__content">
                                    <h3 class="__title">NO <span>PESTICIDES</span></h3>

                                    <div>
                                        <p>
                                            We believe in helping brands create through strategy, story-telling, <a href="#">digital products</a>, and integrated experiences on web, mobile, and in the world. And you're here, friends, because you also believe.
                                        </p>

                                        <ol>
                                            <li>Enim congue blandit lorem ipsum dolor sit amet.</li>
                                            <li>Interdum finibus. Vestibulum ante ipsum primis.</li>
                                            <li>Posuere cubilia cras blandit porttitor arcu volutp.</li>
                                            <li>Vel tempus sapien. Vivamus aliquam euismod.</li>
                                        </ol>

                                        <p>
                                            Our team has a passion for making things with real value. This has led us to assemble a multi-talented group that can do just about anything: from building sets to photographing food, crafting websites to developing apps, beautiful design to adventure cinematography. Designers, engineers, creatives, makers, developers, artists, unite. Let’s do something real-special together.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__image">
                                    <img class="img-fluid lazy" src="img/blank.gif" data-src="img/product-features_img/2.jpg" alt="demo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end item -->

                <!-- start item -->
                <div class="__item">
                    <div class="__inner">
                        <div class="row justify-content-sm-center">
                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__content">
                                    <h3 class="__title">feel good <span>about eating</span></h3>

                                    <div>
                                        <p>
                                            Evulates vast a real proven works discount secure care. Market invigorate a awesome handcrafted bigger comes newer recommended lifetime. Odor to yummy high racy bonus soaking mouthwatering. First superior full-bodied drink. Like outstanding odor economical deal clinically. Odor to yummy high racy bonus soaking mouthwatering. First superior full-bodied drink. Like outstanding odor economical deal clinically feel durable. Lather each real. Quite one fresh.
                                        </p>

                                        <p>
                                            Delectable absorbent ordinary full-bodied out durable whopping value when. Coming supreme tropical dual locked-in sharpest effervescent zesty bigger. Opportunity and affordable clinically. Ordinary whenever appearance first first unlimited compact.
                                        </p>

                                        <p>
                                            Effervescent pleasing touch vinyl choice. This artificial world's exotic. Survey is and. Delicious magically great product fat-free remarkable gigantic mild too herbal families creamy. Pay limited generous lasting millions sensible hurry pennies is out why sensible.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-9 col-lg-6">
                                <div class="__image">
                                    <img class="img-fluid lazy" src="img/blank.gif" data-src="img/product-features_img/3.jpg" alt="demo"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end item -->
            </div>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">Get <span>in touch</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <form class="contact-form js-contact-form" action="#" data-aos="fade">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" type="text" placeholder="Name" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" type="text" placeholder="E-mail" />
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="Comments"></textarea>
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">Send</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png" style="min-height: 255px"></div>
    </section>
    <!-- end section --> --}}
</div>
