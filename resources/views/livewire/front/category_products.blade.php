@extends('front.layouts.master7')
@section('css')
    <style>
        .product-wish {
            position: absolute;
            top: 3%;
            left: 0;
            z-index: 99;
            right: 30px;
            text-align: right;
            padding-top: 0;
        }

        .product-wish .fa {
            /* color:red; */
            font-size: 30px;
        }

        .product-wish .fa:hover {
            color: #ff7007;
            font-size: 30px;
        }

        .fill-heart {
            color: #ff7007 !important;
        }

    </style>
@endsection

@section('content')
<div class="col-12 col-md-12 col-lg-12">
    <div class="spacer py-6 d-md-none"></div>


    <div class="spacer py-3"></div>

        <center>  {{$products}}</center><br>

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
                        <div class="col-12 col-sm-6 col-lg-3">
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
                                                {{ number_format($product->getPrice(), 2) }} $
                                                {{ $product->getUnit()->Name }}
                                            </span>
                                            <span
                                                class="product-price__item product-price__item--new">{{ number_format($product->special_price, 2) }} $
                                                {{ $product->getUnit()->Name }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span
                                                class="product-price__item product-price__item--new">
                                                {{ number_format($product->getPrice(), 2) }} $
                                                {{ $product->getUnit()->Name }}
                                            </span>
                                        </div>
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
                <div class="col-12 col-sm-12 col-lg-12" style="padding-right: 36%;"><center><h2 style="color: green;">{{ __('website\search.no_cat_product') }}</h2></center></div>
                @endif
            </div>
        </div>
    </div>
    <!-- end goods -->

    <div class="spacer py-5"></div>

</div>
@endsection
