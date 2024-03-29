@section('title', __('website\home.shop'))
@section('css')
@if(app()->getLocale()=='ar')
<style>
    .product-wish{
        position: absolute;
        bottom :3%;
        z-index:99;
        left:30px;
        text-align: right;
        padding-top:0;
    }
    .product-wish .fa {
        /* color:red; */
        font-size: 30px;
    }
    .product-wish .fa:hover {
        color:#ff7007;
        font-size: 30px;
    }
    .fill-heart{
        color: #ff7007 !important;
    }
</style>
@else

<style>
    .product-wish{
        position: absolute;
        top:3%;
        left: 0;
        z-index:99;
        right:30px;
        text-align: right;
        padding-top:0;
    }
    .product-wish .fa {
        /* color:red; */
        font-size: 30px;
    }
    .product-wish .fa:hover {
        color:#ff7007;
        font-size: 30px;
    }
    .fill-heart{
        color: #ff7007 !important;
    }
</style>
@endif
@endsection
<div>
    <!-- start section -->
    <section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo" />
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
                                @livewire('front.header-search-component')
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
                                    <h4 class="h6 widget-title">
                                        Price
                                        {{-- <span class="text-base" style=""> --}}
                                         {{ config('app.Currency') }}{{ $min_price }} -  {{ config('app.Currency') }}{{ $max_price }}
                                        {{-- </span> --}}
                                    </h4>
                                    <div style="padding:10px 5px 40px 5px;">
                                        <div id="slider" wire:ignore>

                                        </div>
                                    </div>
                                </div>
                                <!-- end widget -->



                                <!-- start widget -->
                                <div class="widget widget--tags">
                                    <h4 class="h6 widget-title">Popular Tags</h4>

                                    <ul>
                                        @foreach ($tags as $tag)
                                            <li><a href="#">{{ $tag->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- end widget -->



                                <!-- start widget -->
                                <div class="widget widget--products">
                                    <h4 class="h6 widget-title">{{ __('Admin/site.featproducts') }}</h4>

                                    <ul>
                                        @foreach ($newProducts as $product)
                                            <li>
                                                <div class="row no-gutters">
                                                    <div class="col-auto __image-wrap">
                                                        <figure class="__image">
                                                            <a
                                                                href="{{ route('product_details', encrypt($product->id)) }}">
                                                                @if ($product->image_path)
                                                                    <img src="{{ $product->image_path }}"
                                                                        data-src="{{ $product->image_path }}"
                                                                        alt="{{ $product->name }}" />
                                                                @else
                                                                    <img src="{{ asset('Dashboard/img/Default/default_product.jpg') }}"
                                                                        data-src="{{ asset('Dashboard/img/Default/default_product.jpg') }}"
                                                                        alt="{{ $product->name }}" />
                                                                @endif
                                                            </a>
                                                        </figure>
                                                    </div>

                                                    <div class="col">
                                                        <h4 class="h6 __title"><a
                                                                href="{{ route('product_details', encrypt($product->id)) }}">{{ $product->name }}</a>
                                                        </h4>

                                                        {{-- <div class="rating">
                                                            <span class="rating__item rating__item--active"><i
                                                                    class="fontello-star"></i></span>
                                                            <span class="rating__item rating__item--active"><i
                                                                    class="fontello-star"></i></span>
                                                            <span class="rating__item rating__item--active"><i
                                                                    class="fontello-star"></i></span>
                                                            <span class="rating__item rating__item--active"><i
                                                                    class="fontello-star"></i></span>
                                                            <span class="rating__item"><i
                                                                    class="fontello-star"></i></span>
                                                        </div> --}}

                                                        @if ($product->special_price > 0)
                                                            <div class="product-price">
                                                                <span
                                                                    class="product-price__item product-price__item--old">
                                                                    {{ number_format($product->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                    {{ $product->getUnit()->Name }}
                                                                </span>
                                                                <span
                                                                    class="product-price__item product-price__item--new">
                                                                    {{ number_format($product->special_price, 2) }}  {{ config('app.Currency') }}
                                                                    {{ $product->getUnit()->Name }}
                                                                </span>
                                                            </div>
                                                        @else
                                                            <div class="product-price">
                                                                <span
                                                                    class="product-price__item product-price__item--new">
                                                                    {{ number_format($product->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                    {{ $product->getUnit()->Name }}
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- end widget -->

                                <!-- start widget -->
                                {{-- <div class="widget widget--banner">
                                    <a href="#"><img class="img-fluid  lazy" src="img/blank.gif"
                                            data-src="img/widget_banner_2.jpg" alt="demo" /></a>
                                </div> --}}
                                <!-- end widget -->
                            </div>
                        </aside>
                    </div>

                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="spacer py-6 d-md-none"></div>

                        <div class="row align-items-center justify-content-between">
                            <div class="col-auto">
                                <span class="goods-filter-btn-open js-toggle-filter"><i
                                        class="fontello-filter"></i>Filter</span>
                            </div>

                            <div class="col-auto">
                                <style>
                                    .textfield.nice-select {
                                        padding-right: 177px !important;
                                        /* display:inline !important; */
                                        display:none !important;
                                    }
                                    .textfield {
                                        /* display:none !important; */
                                        display:inline !important;
                                    }
                                </style>
                                <div class="input-wrp" >
                                    <select name="orderby" class=" textfield wide js-select" wire:model='sorting' >
                                        <option value="default" selected="selected">{{ __('Website/home.allproducts') }}</option>
                                        <option value="new_to_old">{{ __('Website/home.new_to_old') }}</option>
                                        <option value="old_to_new">{{ __('Website/home.old_to_new') }}</option>
                                        <option value="price_high_to_low">{{ __('Website/home.price_high_to_low') }}</option>
                                        <option value="price_low_to_high">{{ __('Website/home.price_low_to_high') }}</option>
                                        <option value="newoffer_from_low_to_high">{{ __('Website/home.newoffer_from_low_to_high') }}</option>
                                        <option value="newoffer_from_high_to_low">{{ __('Website/home.newoffer_from_high_to_low') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <!-- start ordering -->
                                {{-- <form class="ordering" action="#"> --}}
                                <div class="input-wrp">
                                    <select name="post-per-page" class="textfield wide js-select" wire:model='pagesize'>
                                        <option value="12" selected="selected">12 {{ __('Website/home.perpage') }}</option>
                                        <option value="16">16 {{ __('Website/home.perpage') }}</option>
                                        <option value="18">18 {{ __('Website/home.perpage') }}</option>
                                        <option value="21">21 {{ __('Website/home.perpage') }}</option>
                                        <option value="24">24 {{ __('Website/home.perpage') }}</option>
                                        <option value="30">30 {{ __('Website/home.perpage') }}</option>
                                        <option value="32">32 {{ __('Website/home.perpage') }}</option>
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
                                    @php
                                        $witems = Cart::instance('wishlist')
                                            ->content()
                                            ->pluck('id');
                                    @endphp
                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                            <!-- start item -->
                                            <div class="col-12 col-sm-6 col-lg-4">
                                                <div class="__item">
                                                    <figure class="__image">
                                                        @if ($product->image_path)
                                                            <a
                                                                href="{{ route('product_details', encrypt($product->id)) }}">
                                                                <img width="188"
                                                                    src="{{ $product->image_path }}"
                                                                    data-src="{{ $product->image_path }}"
                                                                    alt="{{ $product->name }}" />
                                                            </a>
                                                        @else
                                                            <img width="188"
                                                                src="{{ asset('Dashboard/img/Default/default_product.jpg') }}"
                                                                data-src="{{ asset('Dashboard/img/Default/default_product.jpg') }}"
                                                                alt="{{ $product->name }}" />
                                                        @endif
                                                    </figure>

                                                    <div class="__content">
                                                        <h4 class="h6 __title"><a
                                                                href="{{ route('product_details', encrypt($product->id)) }}">{{ $product->name }}</a>
                                                        </h4>

                                                        {{-- <div class="__category"><a href="#">
                                                                @foreach ($product->categories as $category)
                                                                    <div class="text-primary text-bold">
                                                                        <span>{{ $category->name }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </a></div> --}}
                                                            <div class="stock-info in-stock">
                                                                <p class="availability">
                                                                    <b
                                                                        class="text {{ $product->stock == 1 ? 'text-success' : 'text-danger' }}">
                                                                        {{ $product->stock == 1 ? __('Admin/site.stock') : __('Admin/site.outstock') }}
                                                                    </b>
                                                                </p>
                                                            </div>
                                                            @if ($product->special_price > 0)
                                                                <div class="product-price">
                                                                    <span
                                                                        class="product-price__item product-price__item--old">
                                                                        {{ number_format($product->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                        {{ $product->getUnit()->Name }}
                                                                    </span>
                                                                    <span
                                                                        class="product-price__item product-price__item--new">
                                                                        {{ number_format($product->special_price, 2) }}  {{ config('app.Currency') }}
                                                                        {{ $product->getUnit()->Name }}
                                                                    </span>
                                                                </div>
                                                            @else
                                                                <div class="product-price">
                                                                    <span
                                                                        class="product-price__item product-price__item--new">
                                                                        {{ number_format($product->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                        {{ $product->getUnit()->Name }}
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        @if (Auth::guard('vendor')->user() )
                                                        @if($product->in_stock ==1)
                                                            <a class="custom-btn custom-btn--medium custom-btn--style-1" title="{{ __('Admin/site.addtocart') }}"
                                                                href="#" id="add-to-cart-cartbtnbtn" onclick="myFunction()"
                                                                wire:click.prevent="store({{ $product->id }},'{{ $product->name ? $product->name : ' ' }}',{{ $product->special_price ? $product->special_price : $product->getPrice() }})">
                                                                <i class="fontello-shopping-bag"></i>
                                                                {{ __('Admin/site.addtocart') }}
                                                            </a>
                                                            {{-- wishlist route ******************* *************************************** --}}
                                                            <div class="product-wish">
                                                                @if ($witems->contains($product->id))
                                                                    <a href="#"
                                                                        wire:click.prevent=" removeWishlist({{ $product->id }}) ">
                                                                        <i class="fa fa-heart fill-heart"></i>
                                                                    </a>
                                                                @else
                                                                    <a href="#"
                                                                        wire:click.prevent=" addToWishlist({{ $product->id }},'{{ $product->name ? $product->name : ' ' }}',{{ $product->special_price ? $product->special_price : $product->getPrice() }}) ">
                                                                        <i class="fa fa-heart"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            {{-- wishlist route ******************* *************************************** --}}
                                                        @endif
                                                        @endif
                                                    </div>

                                                    @if ($product->special_price > 0)
                                                        <span
                                                            class="product-label product-label--sale">{{ __('Admin/site.sale') }}</span>
                                                    @else
                                                        <span
                                                            class="product-label product-label--new">{{ __('Admin/site.new') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- end item -->
                                        @endforeach
                                    @else
                                        <h3 style="color: #e71d1d;"> ({{ __('Admin/site.no_data_found') }})</h3>
                                    @endif
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

                            {{-- @if (count($products))
                                {{ $products->links('page-links') }}
                            @endif --}}
                        </nav>
                        <!-- end pagination -->
                    </div>
                </div>
            </div>
            <!-- end goods catalog -->

        </div>
    </section>

</div>
@push('js')
    <script>
        var slider = document.getElementById('slider');
        noUiSlider.create(slider, {
            start: [1, 10000],
            connect: true,
            range: {
                'min': 1,
                'max': 10000
            },
            pips: {
                mode: 'steps',
                stepped: true,
                density: 4
            }
        });
        slider.noUiSlider.on('update', function(value) {
            @this.set('min_price', value[0]);
            @this.set('max_price', value[1]);
        });
    </script>
        <script>
            function myFunction() {
                console.log('clicked');
                alert('{{ __('Website/home.item_added_to_cart') }}');
                            // this.text('{{ __('Admin/site.loading') }}');
                    //  $("this").text("{{ __('Admin/site.adding_to_cart') }}");
                    // document.getElementById("add-to-cart-cartbtnbtn").innerText = "{{ __('Admin/site.adding_to_cart') }}";
                    // document.getElementById("add-to-cart-cartbtnbtn").attr("disabled", true);
                    // document.getElementById("add-to-cart-cartbtnbtn").classList.add("disabled");
                    // document.getElementById("add-to-cart-cartbtnbtn").classList.remove("custom-btn--style-1");
                    // document.getElementById("add-to-cart-cartbtnbtn").classList.add("btn-loading");
                    // document.getElementById("add-to-cart-cartbtnbtn").disabled = false;

            }
        </script>
@endpush
