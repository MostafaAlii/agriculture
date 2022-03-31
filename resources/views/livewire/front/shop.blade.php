<div>
@section('title', __('website\home.shop'))
@section('css')
{{-- <style>
    .pl-4, .px-4{
    padding-left:1.5rem !important;
}
    .pb-2, .py-2{
    padding-bottom:.5rem !important;
}
    .pt-2, .py-2{
    padding-top:.5rem !important;
}
.bg-white{
    background-color: #fff !important;
}
.border{
    border: 1px solid #dee2e6 !important;
}
nav svg {
    height: 20px;
}
svg{
    overflow: hidden;
    vertical-align: middle;
}
.wrap-pagination-info{
    margin-top: 46px;
    border-top:1px solid #e6e6e6;
    padding-top: 10px;
}
</style> --}}
@endsection
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
                                {{-- <form class="ordering" action="#"> --}}
                                    <div class="input-wrp">
                                        <select name="orderby" class="textfield wide js-select" wire:model='sorting'>
                                            <option value="default" selected="selected">Default sorting</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div>
                                {{-- </form> --}}
                                <!-- end ordering -->
                            </div>
                            <div class="col-auto">
                                <!-- start ordering -->
                                {{-- <form class="ordering" action="#"> --}}
                                    <div class="input-wrp">
                                        <select name="post-per-page" class="textfield wide js-select" wire:model='pagesize' >
                                            <option value="12" selected="selected">12 per page</option>
                                            <option value="16">16 per page</option>
                                            <option value="18">18 per page</option>
                                            <option value="21">21 per page</option>
                                            <option value="24">24 per page</option>
                                            <option value="30">30 per page</option>
                                            <option value="32">32 per page</option>
                                        </select>
                                    </div>
                                {{-- </form> --}}
                                <!-- end ordering -->
                            </div>
                        </div>

                        <div class="spacer py-3"></div>

                        <!-- start goods -->
                        <div class="goods goods--style-1">
                            <div class="__inner">
                                <div class="row">
                                    @foreach ($products as $product)
                                    <!-- start item -->
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="__item">
                                                <figure class="__image">
                                                    @if($product->image->filename)
                                                        <a href="{{ route('product_details',$product->id) }}">
                                                            <img class="lazy" width="188" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                                        data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                                        </a>
                                                    @else
                                                        <img class="lazy" width="188" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                        data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                    @endif
                                                </figure>

                                                <div class="__content">
                                                    <h4 class="h6 __title"><a href="{{ route('product_details',$product->id) }}">{{ $product->name }}</a></h4>

                                                    {{-- <div class="__category"><a href="#">{{ $product->categories }}</a></div> --}}

                                                    <div class="product-price">
                                                        <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                                    </div>

                                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"><i class="fontello-shopping-bag"></i>Add to cart</a>
                                                </div>

                                                <span class="product-label product-label--sale">Sale</span>
                                            </div>
                                        </div>
                                    <!-- end item -->
                                    @endforeach
                                    {{-- <!-- start item -->
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
                                    <!-- end item --> --}}
                                </div>
                            </div>
                        </div>
                        <!-- end goods -->

                        <div class="spacer py-5"></div>

                        <!-- start pagination -->
                        <nav aria-label="Page navigation example">
                            {{-- <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">4</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fontello-angle-right"></i></a></li>
                            </ul> --}}

                            @if (count($products))
                            {{ $products->links('page-links') }}
                            @endif
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
</div>
