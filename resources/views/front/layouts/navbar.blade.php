<ul>

    {{--  start links in navebar *************************************************************************--}}
    <li> <a href="{{ route('home') }}">{{ __('home') }}</a> </li>
    <li> <a href="{{ route('aboutUs') }}">{{ __('about') }}</a> </li>
    <li> <a href="/shop">{{ __('Shop') }}</a> </li>

    {{--  start links in navebar *************************************************************************--}}
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
