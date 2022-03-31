<div>
    @section('title', __('website\home.checkout'))
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

                    <!-- start checkout -->
                    <div class="checkout">
                        <h2>BILLING <span>DETAILS</span></h2>

                        <div class="spacer py-3"></div>

                        <form class="checkout__form" action="#">
                            <div class="row justify-content-xl-between">
                                <div class="col-12 col-md-5 col-lg-6">
                                    <div><h6>Personal Information</h6></div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="First name *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Last name *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Company name (optional)" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Phone *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Email address *" type="text" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="spacer py-6"></div>

                                    <div><h6>Adress</h6></div>

                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <select class="textfield wide js-select">
                                                    <option>Country * 1</option>
                                                    <option>Country * 2</option>
                                                    <option>Country * 3</option>
                                                    <option>Country * 4</option>
                                                    <option>Country * 5</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Town / City *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="State / County *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-12 col-lg-6">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="ZIP *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <input class="textfield" placeholder="Street address *" type="text" />
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-wrp">
                                                <textarea class="textfield" placeholder="Order notes (optional)"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Ship to different address?</button>

                                    <div class="spacer py-6 d-md-none"></div>
                                </div>

                                <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                                    <div><h6>Your products</h6></div>

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
                                    </div>

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
                                                    <td>$96.00</td>
                                                </tr>

                                                <tr>
                                                    <td>Shipping</td>
                                                    <td>Flat rate: $3.00 <br>Shipping to Ukraine.</td>
                                                </tr>

                                                <tr>
                                                    <td>Total</td>
                                                    <td>$99.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
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
