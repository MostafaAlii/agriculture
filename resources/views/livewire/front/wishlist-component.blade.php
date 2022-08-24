@section('title', __('website\home.wishlist'))
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

            <!-- start goods catalog -->
            <div class="goods-catalog">
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <aside class="sidebar goods-filter">
                            <span class="goods-filter-btn-close js-toggle-filter"><i class="fontello-cancel"></i></span>

                            <div class="goods-filter__inner">
                            </div>
                        </aside>
                    </div>
                    <div class="col-12 col-md-8 col-lg-9">
                        <div class="spacer py-6 d-md-none"></div>
                        <div class="spacer py-3"></div>
                        <div class="goods goods--style-1">
                            <div class="__inner">
                                <div class="row">
                                    @if (Cart::instance('wishlist')->content()->count() > 0)
                                                @foreach (Cart::instance('wishlist')->content() as $product)
                                                <!-- start item -->
                                                    <div class="col-12 col-sm-6 col-lg-4">
                                                        <div class="__item">
                                                            <figure class="__image">
                                                                @if($product->model->image)
                                                                    <a href="{{ route('product_details',encrypt($product->model->id)) }}">
                                                                        <img  width="188" src="{{ asset('Dashboard/img/products/'. $product->model->image->filename) }}"
                                                                    data-src="{{ asset('Dashboard/img/products/'. $product->model->image->filename) }}" alt="demo" />
                                                                    </a>
                                                                @else
                                                                    <img  width="188" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                                    data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                                @endif
                                                            </figure>

                                                            <div class="__content">
                                                                <h4 class="h6 __title"><a href="{{ route('product_details',encrypt($product->model->id)) }}">{{ $product->model->name }}</a></h4>
                                                                    <div class="stock-info in-stock">
                                                                        <p class="availability">
                                                                            <b
                                                                                class="text {{ $product->model->stock == 1 ? 'text-success' : 'text-danger' }}">
                                                                                {{ $product->model->stock == 1 ? __('Admin/site.stock') : __('Admin/site.outstock') }}
                                                                            </b>
                                                                        </p>
                                                                    </div>

                                                                    @if ($product->model->special_price > 0)
                                                                        <div class="product-price">
                                                                            <span
                                                                                class="product-price__item product-price__item--old">
                                                                                {{ number_format($product->model->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                            <span
                                                                                class="product-price__item product-price__item--new">
                                                                                {{ number_format($product->model->special_price, 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-price">
                                                                            <span
                                                                                class="product-price__item product-price__item--new">
                                                                                {{ number_format($product->model->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif

                                                                <a class="custom-btn custom-btn--medium custom-btn--style-1"
                                                                    href="#"
                                                                    wire:click.prevent="moveProductFromWishlistToCart('{{ $product->rowId }}')" >
                                                                    <i class="fontello-shopping-bag"></i>
                                                                    {{ __('Admin/site.addtocart') }}
                                                                </a>
                                                {{-- wishlist route ******************* ***************************************--}}

                                                                    <div class="product-wish">
                                                                        <a href="#" wire:click.prevent=" removeWishlist({{ $product->model->id }}) ">
                                                                            <i class="fa fa-heart fill-heart"></i>
                                                                        </a>
                                                                    </div>
                                                {{-- wishlist route ******************* ***************************************--}}
                                                            </div>
                                                            @if($product->model->special_price >0)
                                                            <span class="product-label product-label--sale">{{ __('Admin/site.sale') }}</span>
                                                            @else
                                                            <span class="product-label product-label--new">{{ __('Admin/site.new') }}</span>
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
        var slider=document.getElementById('slider');
        noUiSlider.create(slider,{
            start :[1,10000],
            connect:true,
            range :{
                'min':1,
                'max':10000
            },
            pips:{
                mode:'steps',
                stepped:true,
                density:4
            }
        });
        slider.noUiSlider.on('update',function(value){
            @this.set('min_price',value[0]);
            @this.set('max_price',value[1]);
        });
    </script>
@endpush
