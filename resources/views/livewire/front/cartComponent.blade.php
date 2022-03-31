<div>
    @section('title', __('website\home.cart'))
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
                <div class="col-12">

                    <!-- start cart -->
                    <div class="cart">
                        <form class="cart__form" action="#">
                            <div class="cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <td width="10%">&nbsp;</td>
                                            <td width="35%">added products</td>
                                            <td width="15%">Price</td>
                                            <td width="20%">Quantity</td>
                                            <td width="15%">Total</td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(Session::has('success_message'))
                                            <div class="alert alert-success">
                                                <strong>Success </strong> {{ Session::get('success_message') }}
                                            </div>
                                        @endif
                                        @if(Cart::instance('cart')->count() > 0)

                                            @foreach(Cart::instance('cart')->content() as $item)
                                            <tr>
                                                <td>
                                                    <figure class="__image">
                                                        <a href="#">
                                                            <img class="lazy" src="img/blank.gif" data-src="img/goods_img/5.jpg" alt="demo" />
                                                        </a>
                                                        @if($item->model->image->filename)
                                                            <a href="{{ route('product_details',$item->model->id) }}">
                                                                <img class="lazy"  src="{{ asset('Dashboard/img/products/'. $item->model->image->filename) }}"
                                                                data-src="{{ asset('Dashboard/img/products/'. $item->model->image->filename) }}" alt="demo" />
                                                            </a>
                                                    @else
                                                            <img class="lazy" width="188" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                            data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                    @endif
                                                    </figure>
                                                </td>

                                                <td>
                                                    <a href="{{ route('product_details',$item->model->id) }}" class="__name">{{ $item->model->name }}</a>
                                                </td>

                                                <td>
                                                    <span class="__price">{{ number_format($item->model->price, 2) }} $</span>
                                                </td>

                                                <td>
                                                    <div class="quantity-counter js-quantity-counter">
                                                        <span class="__btn __btn--minus" wire:click.prevent="decreaseQuntity('{{ $item->rowId }}')" ></span>
                                                        <input class="__q-input"
                                                        type="text"
                                                        name="product-quatity"
                                                        min="1"
                                                        {{-- max="{{ $item->model->qty }}" --}}
                                                        {{-- value="{{ $item->qty }}" --}}
                                                        value="{{ $item->qty }}"
                                                        onkeydown="return false" />
                                                        <span class="__btn __btn--plus" wire:click.prevent="increaseQuntity('{{ $item->rowId }}')" ></span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="__total">{{ number_format($item->subtotal,2) }} $</span>
                                                </td>

                                                <td>
                                                    <a class="__remove" href="#" aria-label="Remove this item"
                                                       wire:click.prevent="destroy('{{ $item->rowId }}')" >
                                                        <i class="fontello-cancel"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        @else
                                        <p>No item in cart</p>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="py-5"></div>

                            <div class="row justify-content-md-between">
                                <div class="col-12 col-md-6">

                                    <div class="cart__coupon form--horizontal">
                                        <div class="input-wrp">
                                            <input class="textfield" type="text" placeholder="Coupon code" />
                                        </div>

                                        <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Apply Coupon</button>
                                    </div>

                                </div>

                                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                                    <div class="spacer py-5 d-md-none"></div>

                                    <div class="cart__total">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td colspan="2"><h3>CART <span>TOTALS</span></h3></td>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="2">
                                                        <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">Proceed to checkout</a>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                <tr>
                                                    <td>Subtotal:</td>
                                                    <td>${{ Cart::instance('cart')->subtotal() }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>Flat rate: ${{ Cart::instance('cart')->tax() }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Total</td>
                                                    <td>${{ Cart::instance('cart')->total() }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- start cart -->

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
