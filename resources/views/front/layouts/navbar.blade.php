<ul>
    {{--  start links in navebar *************************************************************************--}}
    <li> <a href="{{ route('front') }}">{{ __('home') }}</a> </li>
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

        {{-- <li class="li-btn">
            <a class="custom-btn custom-btn--small custom-btn--style-4" href="#">Get in Touch</a>
        </li> --}}

    @check_guard
       {{-- <li class="menu-item" ><a title="Login" href="{{ route('user.login') }}">Login</a></li> --}}
       <li class="li-btn">
            <a class="custom-btn custom-btn--medium custom-btn--style-1" title="Login" href="{{ route('user.login') }}">
                Login
            </a>
        </li>
    @endcheck_guard
{{-- fix bug navbar *******************************--}}
{{-- fix bug navbar *******************************--}}
{{-- fix bug navbar *******************************--}}
    @if(Auth::guard('web')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">My Account {{ Auth::user()->name }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="Dashboard" href="{{ route('farmer.dashboard') }}">Dashboard</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">My Order</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">Change Password</a>
                </li>

                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out-farmer').submit();">
                        Log out
                    </a>
                </li>
                <form id="log-out-farmer" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>

            </ul>
        </li>
    @endif
    @if(Auth::guard('vendor')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">My Account {{ Auth::guard('vendor')->user()->firstname }} {{ Auth::guard('vendor')->user()->lastname }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="Dashboard" href="#">Dashboard</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">My Order</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">Change Password</a>
                </li>

                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout.user') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                        Log out
                    </a>
                </li>
                <form id="log-out" action="{{ route('logout.user') }}" method="POST">
                    @csrf
                </form>

            </ul>
        </li>
    @endif
    @if(Auth::guard('admin')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">Welcom Mr : {{ Auth::guard('admin')->user()->name }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="Dashboard" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout.admin') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                        Log out
                    </a>
                </li>
                <form id="log-out" action="{{ route('logout.admin') }}" method="POST">
                    @csrf
                </form>
            </ul>
        </li>
    @endif

</ul>
