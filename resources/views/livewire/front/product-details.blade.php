<div>
    @section('title', __('website\home.productdetails'))
    @section('css')

    @endsection
    	<!-- start section -->
        <section class="section">
            <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo"/>
            </div>

            <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo"/>
            </div>

            <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo"/>
            </div>

            <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo"/>
            </div>

            <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
                <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo"/>
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
                                            <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                        </div>

                                        <div class="rating">
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item"><i class="fontello-star"></i></span>
                                        </div>

                                        <p>
                                            {{ $product->description }}
                                        </p>


                                        <form class="__add-to-cart" action="#">
                                            <div class="quantity-counter js-quantity-counter">
                                                <span class="__btn __btn--minus"  wire:click.prevent='decreaseQty' ></span>
                                                <input class="__q-input"
                                                type="text"
                                                name="product-quatity"
                                                min="1"
                                                {{-- max="{{ $item->model->qty }}" --}}
                                                {{-- value="{{ $item->qty }}" --}}
                                                value="1"
                                                onkeydown="return false"
                                                wire:model='qty' />
                                                <span class="__btn __btn--plus" wire:click.prevent='increaseQty' ></span>
                                            </div>





                                            <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                            type="submit" role="button"
                                            wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                                            <i class="fontello-shopping-bag"></i>
                                                {{ __('Admin/site.addtocart') }}
                                            </button>
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
                                                    {{ $product->description }}
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

                                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>{{ __('Admin/site.addtocart') }}</a>
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
                                <h4 class="h6 widget-title">{{ __('Admin/site.featproducts') }}</h4>

                                <ul>
                                    @foreach ($featuredProducts as $product)
                                    <li>
                                        <div class="row no-gutters">
                                            <div class="col-auto __image-wrap">
                                                <figure class="__image">
                                                    <a href="{{ route('product_details',$product->id) }}">
                                                        @if($product->image->filename)
                                                            <img class="lazy" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                                            data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                                        @else
                                                            <img class="lazy" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                            data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                        @endif

                                                    </a>
                                                </figure>
                                            </div>

                                            <div class="col">
                                                <h4 class="h6 __title"><a href="{{ route('product_details',$product->id) }}">{{ $product->name }}</a></h4>

                                                <div class="rating">
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item"><i class="fontello-star"></i></span>
                                                </div>

                                                <div class="product-price">
                                                    <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                                    {{-- <span class="product-price__item product-price__item--old">4.11 $</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
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
</div>
