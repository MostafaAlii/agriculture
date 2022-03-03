<header id="top-bar" class="top-bar top-bar--style-1">
    <div class="top-bar__bg" style="background-color: #24292c;background-image: url({{ URL::asset('frontassets/img/top_bar_bg-1.jpg') }});
    background-repeat: no-repeat;background-position: left bottom;"></div>

    <div class="container-fluid">
        <div class="row align-items-center justify-content-between no-gutters">

            <a class="top-bar__logo site-logo" href="index.html">
                <img class="img-fluid" src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />
            </a>

            <a id="top-bar__navigation-toggler" class="top-bar__navigation-toggler top-bar__navigation-toggler--light" href="javascript:void(0);"><span></span></a>

            <div id="top-bar__inner" class="top-bar__inner">
                <div>
                    <nav id="top-bar__navigation" class="top-bar__navigation navigation" role="navigation">
                        <ul>
                            {{-- <li class="active has-submenu">
                                <a href="javascript:void(0);">Home</a>

                                <ul class="submenu">
                                    <li class="active"><a href="index.html">Home 1</a></li>
                                    <li><a href="index_2.html">Home 2</a></li>
                                    <li><a href="index_3.html">Home 3</a></li>
                                    <li><a href="index_4.html">Home Shop</a></li>
                                </ul>
                            </li> --}}

                            <li> <a href="{{ route('home') }}">{{ __('home') }}</a> </li>
                            
                            <li>
                                <a href="about.html">About</a>
                            </li>

                            <li class="has-submenu">
                                <a href="javascript:void(0);">Pages</a>

                                <ul class="submenu">
                                    <li><a href="services.html">Services</a></li>
                                    <li><a href="products.html">Products</a></li>
                                    <li><a href="products_details.html">Product Details</a></li>
                                    <li><a href="gallery_1.html">Gallery 1</a></li>
                                    <li><a href="gallery_2.html">Gallery 2</a></li>
                                    <li><a href="typography.html">Typography</a></li>
                                    <li><a href="404.html">404 page</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="javascript:void(0);">Shop</a>

                                <ul class="submenu">
                                    <li><a href="shop_catalog.html">Shop Catalog</a></li>
                                    <li><a href="single_product.html">Single Product</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="sign_in.html">Sign In/Up</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="blog.html">Blog</a>
                            </li>

                            <li>
                                <a href="contacts.html">Contacts</a>
                            </li>

                            <li class="li-btn">
                                <a class="custom-btn custom-btn--small custom-btn--style-4" href="#">Get in Touch</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
    </div>
</header>
