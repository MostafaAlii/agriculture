@section('title', __('website\home.checkout'))
@section('css')
<style>
    input[type="text"],
    input[type="tel"],
    input[type="email"],
    input[type="password"],
    textarea[type="textarea"] {
        font-size: 16px; !important
    }
</style>
@endsection
<div>
    {{-- dd($user_id) --}}
    <!-- start section -->
    <section class="section">
        <!-- Start Flower Pic In Background -->
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
        <!-- End Flower Pic In Background -->
        <!-- Start Container -->
        <div class="container">
            <!-- Start Row -->
            <div class="row">
                <!-- Start col-12 -->
                <div class="col-12">
                    <!-- start checkout -->
                    <div class="checkout">
                        <!-- Start Main Content Area -->
                        <div class=" main-content-area">
                            <h2>{{ trans('Website/checkout.details') }} <span>{{ trans('Website/checkout.belling') }}</span></h2>
                            <div class="spacer py-3"></div>
                            <!-- Start Billing Address Form -->
                            <form wire:submit.prevent="placeOrder" autocomplete="off">
                                <div class="wrap-address-billing">
                                    <!-- Start row justify-content-xl-between -->
                                    <div class="row">
                                        <!-- Start col-12 -->
                                        <div class="col-md-12">
                                            <!-- Start Billing Address -->
                                            <h5>{{ trans('Website/checkout.personal_information') }}</h5>
                                            <!-- End First Form Row -->
                                            <div class="form-row">
                                                <!-- Start FirstName -->
                                                <div class="form-group text-lg col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-lg text-center" name="firstname" value="{{-- $user_firstname --}}" wire:model="user_firstname" placeholder="{{ trans('Website/checkout.client_firstname') }}" autocomplete="off" type="text" />
                                                    @error('user_firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End FirstName -->
                                                <!-- Start LastName -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="lastname" value="{{-- $user_lastname --}}" wire:model="user_lastname" placeholder="{{ trans('Website/checkout.client_lastname') }}" autocomplete="off" type="text" />
                                                    @error('user_lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End LastName -->
                                                <!-- Start Phone -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-lg text-center" name="mobile" value="{{-- $user_mobile --}}" wire:model="user_mobile" placeholder="{{ trans('Website/checkout.client_phone') }}" autocomplete="off" type="tel" />
                                                    @error('user_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Phone -->
                                            </div>
                                            <!-- End First Form Row -->
                                            <br>
                                            <!-- Start Second Form Row -->
                                            <div class="form-row">
                                                <!-- Start Email -->
                                                <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                                    <input class="form-control text-center" name="email" value="{{-- $user_email --}}" wire:model="user_email" placeholder="{{ trans('Website/checkout.client_email') }}" autocomplete="off" type="email" />
                                                    @error('user_email') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Email -->
                                            </div>
                                            <!-- End Second Form Row -->
                                            <br>
                                            <!-- Start Third Form Row -->
                                            <div class="form-row">
                                                <!-- Start Country -->
                                                <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                    <input class="form-control text-center" name="country" value="{{-- $user_country --}}" wire:model="user_country" placeholder="{{ trans('Website/checkout.client_country') }}" autocomplete="off" type="text" />
                                                    @error('user_country') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Country -->
                                                <!-- Start Proviency -->
                                                <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                    <input class="form-control text-center" name="province" value="{{-- $user_proviency --}}" wire:model="user_proviency" placeholder="{{ trans('Website/checkout.client_proviency') }}" autocomplete="off" type="text" />
                                                    @error('user_proviency') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Proviency -->
                                                <!-- Start Area -->
                                                <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                    <input class="form-control text-center" name="area" value="{{-- $user_area --}}" wire:model="user_area" placeholder="{{ trans('Website/checkout.client_area') }}" autocomplete="off" type="text" />
                                                    @error('user_area') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Area -->
                                                <!-- Start State -->
                                                <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                    <input class="form-control text-center" name="state" value="{{-- $user_state --}}" wire:model="user_state" placeholder="{{ trans('Website/checkout.client_state') }}" autocomplete="off" type="text" />
                                                    @error('user_state') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End State -->
                                            </div>
                                            <!-- End Third Form Row -->
                                            <br>
                                            <!-- Start Fourth Row -->
                                            <div class="form-row">
                                                <!-- Start Village -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="village" value="{{-- $user_village --}}" wire:model="user_village" placeholder="{{ trans('Website/checkout.client_village') }}" autocomplete="off" type="text" />
                                                    @error('user_village') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Village -->
                                                <!-- Start Address -->
                                                <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                                    <input class="form-control text-center" name="address1" value="{{-- $user_address --}}" wire:model="user_address1" placeholder="{{ trans('Website/checkout.client_address') }}" autocomplete="off" type="text" />
                                                    @error('user_address1') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Address -->
                                            </div>
                                            <!-- End Fourth Row -->
                                            <hr><br>
                                            <!-- End Billing Address -->
                                        </div>
                                        <!-- End col-12 -->
                                        <div class="col-md-12 form-group">
                                            <div class="custom-control custom-radio">
                                                <input
                                                    type="checkbox"
                                                    name="diffrent-add"
                                                    id="diffrent-add"
                                                    value="1" wire:model="ship_to_different">
                                                    <label for="diffrent-add" class="text-small">
                                                        <b>{{ trans('Website/checkout.shipping_to_another_address') }}</b>
                                                    </label>
                                            </div>
                                        </div>
                                        @if($ship_to_different)
                                            <!-- Start col-12 Shipping Address -->
                                            <div class="col-md-12">
                                                <!-- Start Shipping Address -->
                                                <h5>{{ trans('Website/checkout.personal_information') }}</h5>
                                                <!-- End First Form Row -->
                                                <div class="form-row">
                                                    <!-- Start FirstName -->
                                                    <div class="form-group text-lg col-12 col-sm-4 col-md-12 col-lg-4">
                                                        <input name="firstname" class="form-control text-lg text-center" wire:model="shipping_firstname" value="" placeholder="{{ trans('Website/checkout.client_firstname') }}" autocomplete="off" type="text" />
                                                        @error('shipping_firstname') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End FirstName -->
                                                    <!-- Start LastName -->
                                                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                        <input name="lastname" class="form-control text-center" value="" wire:model="shipping_lastname" placeholder="{{ trans('Website/checkout.client_lastname') }}" autocomplete="off" type="text" />
                                                        @error('shipping_lastname') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End LastName -->
                                                    <!-- Start Phone -->
                                                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                        <input name="mobile" class="form-control text-lg text-center" value="" wire:model="shipping_mobile" placeholder="{{ trans('Website/checkout.client_phone') }}" autocomplete="off" type="tel" />
                                                        @error('shipping_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Phone -->
                                                </div>
                                                <!-- End First Form Row -->
                                                <br>
                                                <!-- Start Second Foem Row -->
                                                <div class="form-row">
                                                    <!-- Start Email -->
                                                    <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                                        <input name="email" class="form-control text-center" value="" wire:model="shipping_email" placeholder="{{ trans('Website/checkout.client_email') }}" autocomplete="off" type="email" />
                                                        @error('shipping_email') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Email -->
                                                </div>
                                                <!-- End Second Foem Row -->
                                                <br>
                                                <!-- Start Third Form Row -->
                                                <div class="form-row">
                                                    <!-- Start Country -->
                                                    <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                        <input name="country" class="form-control text-center" value="" wire:model="shipping_country" placeholder="{{ trans('Website/checkout.client_country') }}" autocomplete="off" type="text" />
                                                        @error('shipping_country') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Country -->
                                                    <!-- Start Proviency -->
                                                    <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                        <input name="province" class="form-control text-center" value="" wire:model="shipping_proviency" placeholder="{{ trans('Website/checkout.client_proviency') }}" autocomplete="off" type="text" />
                                                        @error('shipping_proviency') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Proviency -->
                                                    <!-- Start Area -->
                                                    <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                        <input name="area" class="form-control text-center" value="" wire:model="shipping_area" placeholder="{{ trans('Website/checkout.client_area') }}" autocomplete="off" type="text" />
                                                        @error('shipping_area') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Area -->
                                                    <!-- Start State -->
                                                    <div class="col-12 col-sm-3 col-md-12 col-lg-3">
                                                        <input name="state" class="form-control text-center" value="" wire:model="shipping_state" placeholder="{{ trans('Website/checkout.client_state') }}" autocomplete="off" type="text" />
                                                        @error('shipping_state') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End State -->
                                                </div>
                                                <!-- End Third Form Row -->
                                                <br>
                                                <!-- Start Fourth Row -->
                                                <div class="form-row">
                                                    <!-- Start Village -->
                                                    <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                        <input name="village" class="form-control text-center" value="" wire:model="shipping_village" placeholder="{{ trans('Website/checkout.client_village') }}" autocomplete="off" type="text" />
                                                        @error('shipping_village') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Village -->
                                                    <!-- Start Address -->
                                                    <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                                                        <input name="address1" class="form-control text-center" value="" wire:model="shipping_address1" placeholder="{{ trans('Website/checkout.client_address') }}" autocomplete="off" type="text" />
                                                        @error('shipping_address1') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Address -->
                                                </div>
                                                <!-- End Fourth Row -->
                                                <br>
                                                <!-- Start Fifth Row -->
                                                <div class="form-row">
                                                    <!-- Start Address -->
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                        <textarea rows="6" class="form-control text-center" name="address2" value="{{-- $user_address --}}" wire:model="shipping_address2" placeholder="{{ trans('Website/checkout.secondry_address') }}" autocomplete="off" type="textarea"></textarea>
                                                        @error('shipping_address2') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                    <!-- End Address -->
                                                </div>
                                                <!-- End Fifth Row -->
                                                <hr><br>
                                                <!-- End Billing Address -->
                                            </div>
                                            <!-- End col-12 Shipping Address -->
                                        @endif
                                    </div>
                                    <!-- End row justify-content-xl-between -->
                                </div>
                                <!-- End Billing Address Form -->
                                <!-- Start Summary Checkout -->
                                <div class="summary summary-checkout">
                                    <div class="summary-item payment-method">
                                        <h4 class="title-box">{{ trans('Website/checkout.payment_way') }}</h4>
                                        <!-- Choose Payment Method -->
                                        <div class="choose-payment-methods">
                                            <div class="row checkRow">
                                                <div class="col-3 form-group">
                                                        <div class="custom-control custom-radio">
                                                            <input
                                                                type="radio"
                                                                id="payment-method-bank"
                                                                value="cod" wire:model="paymentmode">
                                                                <label for="payment-method-bank" class="text-small">
                                                                    <b>{{ trans('Website/checkout.cash_on_delivery') }}</b>
                                                                </label>
                                                            {{--<input
                                                                type="radio"
                                                                id="payment-method-bank"
                                                                value="card" wire:model="paymentmode">
                                                                <label for="payment-method-bank" class="text-small">
                                                                    <b>{{ trans('Website/checkout.credit_card') }}</b>
                                                                </label>
                                                                @error('paymentmode') <span class="text-danger">{{ $message }}</span> @enderror--}}
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Choose Payment Method -->
                                    </div>
                                </div>
                                <!-- End Summary Checkout -->
                                <!-- Start Payment Card Info -->
                                <div class="row">
                                    @if($paymentmode == 'card')
                                        @if(Session::has('paytabs_error'))
                                            <div class="aler alert-danger" role="alert">{{ Session::get('paytabs_error') }}</div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="form-row">
                                                <!-- Start Card Number -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="card-no" wire:model="card_no" placeholder="{{ trans('Website/checkout.card_number_placeholder') }}" autocomplete="off" type="text" />
                                                    @error('card_no') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Card Number -->
                                                <!-- Start Expiry Month -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="exp-month" wire:model="exp_month" placeholder="{{ trans('Website/checkout.expiry_month') }}" autocomplete="off" type="text" />
                                                    @error('exp_month') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Expiry Month -->
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <!-- Start Expiry Year -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="exp-year" wire:model="exp_year" placeholder="{{ trans('Website/checkout.expiry_year') }}" autocomplete="off" type="text" />
                                                    @error('exp_year') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End Expiry Year -->
                                                <!-- Start CVC -->
                                                <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                    <input class="form-control text-center" name="cvc" wire:model="cvc" placeholder="{{ trans('Website/checkout.cvc') }}" autocomplete="off" type="password" />
                                                    @error('cvc') <span class="text-danger">{{ $message }}</span> @enderror
                                                </div>
                                                <!-- End CVC  -->
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- End Payment Card Info -->
                                @if(Session::has('checkout'))
                                    <h6 class="title-box">Total :<p style="" class="text-primary">${{ Session::get('checkout')['total'] }}</p></h6>
                                @endif
                                <!-- Start Submit Button -->
                                @if (Cart::instance('cart')->total() > 0 )
                                   <button type="submit" class="btn btn-dark btn-lg btn-block">{{ trans('Website/checkout.place_order_now') }}</button>
                                @endif
                                <!-- End Submit Button -->
                            </form>
                            <!-- End Form -->
                        </div>
                        <!-- End Main Content Area -->
                    </div>
                    <!-- end checkout -->
                </div>
                <!-- End col-12 -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Container -->
    </section>
    <!-- end section -->

    <!-- start section -->
    {{-- <section class="section section--no-pt section--no-pb section--gutter">
        <div class="container-fluid px-md-0">
            <!-- start banner simple -->
            <div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
                <div class="d-none d-lg-block">
                    @if(app()->getLocale()=='ar')
                        <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}"
                             data-src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}" width="70" height="70"
                             alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                    @else
                        <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}"
                             data-src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}" width="70" height="70"
                             alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                    @endif
                </div>

                <div class="row no-gutters">
                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/banner_bg_3.jpg') }}" alt="demo" /></a>
                    </div>

                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/banner_bg_4.jpg') }}" alt="demo" /></a>
                    </div>
                </div>
            </div>
            <!-- end banner simple -->
        </div>
    </section> --}}
    <!-- end section -->
</div>
