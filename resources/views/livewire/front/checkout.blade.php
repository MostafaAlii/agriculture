@section('title', __('website\home.checkout'))
@section('css')

@endsection
<div>
    {{-- dd($payment_method_id) --}}
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
                    <!-- start checkout -->
                    <div class="checkout">
                        <h2>{{ trans('Website/checkout.details') }} <span>{{ trans('Website/checkout.belling') }}</span></h2>
                        <div class="spacer py-3"></div>
                        <form class="checkout__form" action="#" autocomplete="off">
                            <div class="row justify-content-xl-between">
                                <!-- Start Billing Address & Personal Info -->
                                <div class="col-12 col-md-5 col-lg-6">
                                    <div><h5>{{ trans('Website/checkout.personal_information') }}</h5></div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" value="{{ $user_firstname }}" placeholder="{{ trans('Website/checkout.client_firstname') }}" autocomplete="off" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" value="{{ $user_lastname }}" placeholder="{{ trans('Website/checkout.client_lastname') }}" autocomplete="off" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" value="{{ $user_phone }}" placeholder="{{ trans('Website/checkout.client_phone') }}" autocomplete="off" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" value="{{ $user_email }}" placeholder="{{ trans('Website/checkout.client_email') }}" autocomplete="off" type="text" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <textarea class="textfield" placeholder="{{ trans('Website/checkout.client_address') }}" autocomplete="off" type="text">
                                                    {{ $user_address }}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                                    <div class="spacer py-6 d-md-none"></div>
                                    <br>
                                    <!-- Start Payment Methods -->
                                    <h5 class="text-uppercase mb-4">{{ trans('Website/checkout.payment_way') }}</h5>
                                    <!-- Start Payment Method Row -->
                                    <div class="row">
                                        <div class="col-6 form-group">
                                            @forelse($payment_methods as $payment_method)
                                                <div class="custom-control custom-radio">
                                                    <input
                                                        type="radio"
                                                        id="payment-method-{{ $payment_method->id }}"
                                                        class="custom-control-input"
                                                        wire:model="payment_method_id"
                                                        wire:click="updatePaymentMethod()"
                                                        {{ intval($payment_method_id)==$payment_method->id?'checked':'' }}
                                                        value="{{ $payment_method->id }}">
                                                        <label for="payment-method-{{ $payment_method->id }}" class="custom-control-label text-small">
                                                            <b>{{ $payment_method->name }}</b>
                                                        </label>
                                                </div>
                                            @empty
                                                <p>{{ trans('Website/checkout.payment_method_notFound') }}</p>
                                            @endforelse
                                        </div>
                                    </div>
                                    <!-- End Payment Method Row -->
                                    <!-- Start Payment Method Route -->
                                    @if ($payment_method_id != 0)
                                        @if (\Str::lower($payment_method_code) == 'ppex')
                                            <form action="{{ route('checkout.paypal') }}" method="post">
                                                @method('POST')
                                                @csrf
                                                <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', $payment_method_id) }}" class="form-control">
                                                <button type="submit" name="submit" class="btn btn-dark btn-lg btn-block">
                                                    {{ trans('Website/checkout.continue_payment_with_paypal') }}
                                                </button>
                                            </form>
                                        @endif
                                        @if (\Str::lower($payment_method_code) == 'master')
                                            <form action="{{-- route('checkout.payment.masterCard') --}}" method="post">
                                                @method('POST')
                                                @csrf
                                                <input type="hidden" name="payment_method_id" value="{{ old('payment_method_id', $payment_method_id) }}" class="form-control">
                                                <button type="submit" name="submit" class="btn btn-dark btn-lg btn-block">
                                                    {{ trans('Website/checkout.continue_payment_with_mastercard') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                    <!-- End Payment Method Route -->
                                    <!-- End Payment Methods -->
                                        <!-- Start CouponCode -->
                                        {{--  <div class="spacer py-6"></div>
                                        <div class="checkout-info">
                                            <lablel class="checkbox-field">
                                                <input wire:model="haveCouponCode" value="haveCouponCode" class="frm-input" id="have-code" type="checkbox">
                                                <span>{{ trans('Website/home.haveVoucherCode') }}</span>
                                            </lablel>
                                            @if($haveCouponCode == 'haveCouponCode')
                                                <!-- Start Coupon Form -->
                                                <form wire:submit.prevent="applyDiscount()">
                                                    @if (!session()->has('coupon'))
                                                        <p class="row-in-form">
                                                            <input class="textfield" placeholder="{{ __('Website/home.vocherCodePlaceholder') }}" type="text" wire:model="coupon_code" />
                                                        </p>
                                                    @endif
                                                    @if(session()->has('coupon'))
                                                        <button class="custom-btn custom-btn--medium custom-btn--style-2" type="button" wire:click.prevent="removeCoupon()" role="button">
                                                            {{ __('Website/home.removeCoupon') }}
                                                        </button>
                                                    @else
                                                        <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"role="button">
                                                            {{ __('Website/home.applycoupon') }}
                                                        </button>
                                                    @endif
                                                    
                                                </form>
                                                <!-- End Coupon Form -->
                                            @endif
                                        </div>--}}
                                        <!-- End CouponCode -->
                                </div>
                                <!-- End Billing Address & Personal Info -->
                                <!-- Start Product & Recieved -->
                                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                                    {{--  <div><h6>Your products</h6></div>
                                    <!-- Start Your Product Summary -->
                                    <div class="checkout__table">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td width="65%">
                                                        <div class="d-table">
                                                            <div class="d-table-cell align-middle">
                                                                <figure class="__image">
                                                                    <a href="#">
                                                                        <img class="lazy" src="img/blank.gif" data-src="img/goods_img/5.jpg" alt="demo" />
                                                                    </a>
                                                                </figure>
                                                            </div>

                                                            <div class="d-table-cell align-middle">
                                                                <a href="#" class="__name">Big Banana</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="__amount">x1</span>
                                                    </td>

                                                    <td width="1%">
                                                        <span class="__total">2.99 $</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="65%">
                                                        <div class="d-table">
                                                            <div class="d-table-cell align-middle">
                                                                <figure class="__image">
                                                                    <a href="#">
                                                                        <img class="lazy" src="img/blank.gif" data-src="img/goods_img/8.jpg" alt="demo" />
                                                                    </a>
                                                                </figure>
                                                            </div>

                                                            <div class="d-table-cell align-middle">
                                                                <a href="#" class="__name">Freash Peach</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="__amount">x1</span>
                                                    </td>

                                                    <td width="1%">
                                                        <span class="__total">2.99 $</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td width="65%">
                                                        <div class="d-table">
                                                            <div class="d-table-cell align-middle">
                                                                <figure class="__image">
                                                                    <a href="#">
                                                                        <img class="lazy" src="img/blank.gif" data-src="img/goods_img/2.jpg" alt="demo" />
                                                                    </a>
                                                                </figure>
                                                            </div>

                                                            <div class="d-table-cell align-middle">
                                                                <a href="#" class="__name">Awesome Brocoli</a>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="__amount">x1</span>
                                                    </td>

                                                    <td width="1%">
                                                        <span class="__total">2.99 $</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>--}}
                                    <!-- End Your Product Summary -->
                                    <!-- Start Your Order Recieved -->
                                    <div class="checkout__total">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td colspan="2"><h3>YOUR <span>ORDER</span></h3></td>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" class="__note">
                                                        <p class="__ttl">Direct bank transfer</p>

                                                        <p>
                                                            Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                        </p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2">
                                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>

                                                        <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Place Order</button>
                                                    </td>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                <tr>
                                                    <td>Subtotal:</td>
                                                    <td>{{ $cart_subtotal }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>Flat rate: $3.00 <br>Shipping to Ukraine.</td>
                                                </tr>
                                                @if(session()->has('coupon'))
                                                    <li class="border-bottom my-2"></li>
                                                    <li class="d-flex align-items-center justify-content-between">
                                                        <strong class="small font-weight-bold">Discount <small>({{ session()->get('coupon')['code'] }})</small></strong>
                                                        <span class="text-muted small">- ${{ $cart_discount }}</span>
                                                    </li>
                                                @endif
                                                <tr>
                                                    <td>Tax</td>
                                                    <td>{{ $cart_tax }}</td>
                                                </tr>

                                                <tr>
                                                    <td>Total</td>
                                                    <td>{{ $cart_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- End Your Order Recieved -->
                                </div>
                                <!-- End Product & Recieved -->
                            </div>
                    </div>
                    <!-- end checkout -->

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
