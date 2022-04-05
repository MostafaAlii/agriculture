<ul>
    <li class="active has-submenu">
        <a href="javascript:void(0);">{{ __('website\home.home') }}</a>
        <ul class="submenu">
            <li  class="active" > <a href="{{ route('front') }}">{{ __('website\home.home')}}</a> </li>
            <li                 > <a href="{{ route('front2') }}"> {{ __('website\home.home2') }}</a> </li>
        </ul>
    </li>
    {{--  start links in navebar *************************************************************************--}}

    <li> <a href="{{ route('shop') }}">{{ __('website\home.shop') }}</a> </li>
    <li> <a href="{{ route('blog') }}">{{ __('website\home.blog') }}</a> </li>
    <li> <a href="{{ route('aboutUs') }}">{{ __('website\home.aboutus') }}</a> </li>
    <li> <a href="{{ route('contact') }}">{{ __('website\home.contactus') }}</a> </li>
    <li class="li-cart">
        @livewire('front.cart-count-component')
    </li>
    <li class="li-cart">
        @livewire('front.wishlist-count-component')
    </li>

    <li> <a href="{{ route('checkout') }}">{{ __('website\home.checkout') }}</a> </li>
        {{--  start links in navebar *************************************************************************--}}
        @check_guard
            <li class="has-submenu">
                <a href="javascript:void(0);">{{ __('website\home.login') }}</a>
                <ul class="submenu">
                    <li><a href="{{ route('user.login2') }}">{{ trans('Admin/site.signvendor') }}</a></li>
                    <li><a href="{{ route('farmer.login') }}">{{ trans('Admin/site.signfarmer') }}</a></li>
                </ul>
            </li>
        @endcheck_guard
        {{-- <li class="has-submenu">
            <a href="javascript:void(0);">test</a>

            <ul class="submenu">
                <li><a href="shop_catalog.html">Shop Catalog</a></li>
                <li><a href="single_product.html">Single Product</a></li>
                <li><a href="cart.html">Cart</a></li>
                <li><a href="checkout.html">Checkout</a></li>
                <li><a href="sign_in.html">Sign In/Up</a></li>
            </ul>
        </li> --}}
    {{-- function to check if not auth  *****************(guest)************(guest)*************************** --}}
            {{-- @check_guard
            <li class="li-btn">
                    <a class="custom-btn custom-btn--medium custom-btn--style-1" title="Login"
                    href="{{ route('user.login') }}">
                    {{ __('website\home.login') }}
                    </a>
                </li>
            @endcheck_guard --}}
    {{-- End function to check if not auth  ******************(guest)************(guest)************************--}}
    {{-- links for farmer الفلاح****************************************************--}}
    @if(Auth::guard('web')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">{{ __('Admin/site.welcome') }} : {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="{{ trans('Website/home.dashboard') }}" href="{{ route('farmer.product') }}" target="_blank">{{ trans('Website/home.dashboard') }}</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">{{ trans('Website/home.my_order') }}</a>
                </li>
                <li class="menu-item" >
                    <a title="{{ trans('Website/home.change_password') }}" href="{{ route('farmer.changepass') }}">{{ trans('Website/home.change_password') }}</a>
                </li>

                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out-farmer').submit();">
                    {{ trans('Website/home.logout') }}
                    </a>
                </li>
                <form id="log-out-farmer" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>

            </ul>
        </li>
    @endif
    {{-- links for vendor or user  التاجر*******************************************--}}
    @if(Auth::guard('vendor')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">{{ __('Admin/site.welcome') }} : {{ Auth::guard('vendor')->user()->firstname }} {{ Auth::guard('vendor')->user()->lastname }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="{{ trans('Website/home.dashboard') }}" href="{{ route('user.dash') }}" target="_blank">{{ trans('Website/home.dashboard') }}</a>
                </li>
                <li class="menu-item" >
                    <a title="Order" href="#">{{ trans('Website/home.my_order') }}</a>
                </li>
                <li class="menu-item" >
                    <a title="{{ trans('Website/home.change_password') }}" href="{{ route('user.changepass') }}">{{ trans('Website/home.change_password') }}</a>
                </li>

                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout.user') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                    {{ trans('Website/home.logout') }}
                    </a>
                </li>
                <form id="log-out" action="{{ route('logout.user') }}" method="POST">
                    @csrf
                </form>

            </ul>
        </li>
    @endif
    {{-- links for admin الادمنز والاداره************************************************--}}
    @if(Auth::guard('admin')->user())
        <li class="menu-item menu-item-has-children parent" >
            <a title="My Account" href="#">{{ __('Admin/site.welcome') }} : {{ Auth::guard('admin')->user()->firstname }} {{ Auth::guard('admin')->user()->lastname }}<i class="fa fa-angle-down" aria-hidden="true"></i></a>
            <ul class="submenu curency" >
                <li class="menu-item" >
                    <a title="{{ trans('Website/home.dashboard') }}" href="{{ route('admin.dashboard') }}"target="_blank">{{ trans('Website/home.dashboard') }}</a>
                </li>
                <li class="menu-item" >
                    <a title="Logout" href="{{ route('logout.admin') }}"
                    onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                        {{ trans('Website/home.logout') }}
                    </a>
                </li>
                <form id="log-out" action="{{ route('logout.admin') }}" method="POST">
                    @csrf
                </form>
            </ul>
        </li>
    @endif

    {{-- translate link and flags ************************************************************** --}}
    <li class="">
        <div class="has-submenu">
            <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
               aria-expanded="false">
                @if (App::getLocale() == 'ar')
                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                    <img src="{{ asset('assets/admin/images/flags/saa.jpg') }}" alt="" width="50">
                @else
                    <strong class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                    <img src="{{ asset('assets/admin/images/flags/hi.png') }}" alt="" width="50">
                @endif
                <div class="my-auto">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        @if($properties['native'] == "English")
                            {{-- <i class="flag-icon flag-icon-us"></i> --}}

                        @elseif($properties['native'] == "العربية")
                            <i class="flag-icon flag-icon-eg"></i>
                        @endif
                        {{ $properties['native'] }}
                    </a>
                @endforeach
            </div>
        </div>
    </li>

</ul>
