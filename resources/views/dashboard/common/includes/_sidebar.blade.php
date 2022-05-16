<!-- BEGIN: Main Menu-->
{{-- <div class="main-menu material-menu menu-fixed menu-light menu-accordion
                menu-shadow " data-scroll-to-active="true"> --}}
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <div class="user-profile">
            <div class="user-info text-center pt-1 pb-1">
                @if (isset(Auth::user()->image->filename))
                    <a class="mr-2" href="{{ route('profile.index') }}">
                        <img class="user-img img-fluid rounded-circle" style="width:50%; height:50%;border-radius: 15%;"
                            class="rounded-circle"
                            src="{{ asset('Dashboard/img/admins/' . Auth::user()->image->filename) }}" />
                    </a>
                @else
                    <a class="mr-2" href="{{ route('profile.index') }}">
                        <img class="user-img img-fluid rounded-circle"
                            src="{{ asset('Dashboard/img/admins/avatar.jpg') }}" />
                    </a>
                @endif
                <div class="name-wrapper d-block dropdown text-center">
                    <a class="white dropdown-toggle ml-2" id="user-account" href="{{ route('profile.index') }}"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                            class="user-name">{{ Auth::user()->firstname }}
                            {{ Auth::user()->lastname }}</span></a>
                    <div class="text-light text-center">
                        {{ Auth::user()->type == 'admin' ? __('Admin/site.admins') : __('Admin/site.employee') }}</div>
                    <div class="dropdown-menu arrow" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="material-icons align-middle mr-1">person</i>
                            <span class="align-middle">{{ trans('Admin/site.profile') }}</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout.admin') }}"
                            onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                            <i class="material-icons">power_settings_new</i>
                            @lang('Admin/site.logout')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                 <!-- Start about Us -->
                 <li class=" nav-item">
                        <li>
                            <a class="menu-item" href="{{ route('about_us/show') }}">
                                <i class="material-icons"> info </i>
                                <span data-i18n="Options"> {{ trans('Admin/site.about_us') }}</span>
                            </a>
                        </li>
                </li>
                <!-- End about Us  -->
                
                <!-- Start Dashboard Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <!--<i class="material-icons">drag_indicator</i>-->
                        <span class="menu-title"
                            data-i18n="Dashboard">{{ trans('Admin/setting.dashboard') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Admins & Moderators -->
                        <li>
                            <a class="menu-item" href="#">
                                <i class="icon-user"
                                    style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                <span data-i18n="Vertical">{{ trans('Admin\admins.admins') }}</span>
                            </a>
                            <ul class="menu-content">
                                <li>
                                    <a class="menu-item" href="{{ route('Admins.index') }}">
                                        <i class="icon-badge"
                                            style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span
                                            data-i18n="{{ trans('Admin\admins.admin') }}">{{ trans('Admin\admins.admin') }}</span></a>
                                </li>
                                <li>
                                    <a class="menu-item" href="{{ route('farmers.index') }}">
                                        <i class="icon-user-follow"
                                            style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span
                                            data-i18n="{{ __('Admin/site.farmer') }}">{{ __('Admin/site.farmer') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="{{ route('workers.index') }}">
                                        <i class="icon-user-follow"
                                            style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span
                                            data-i18n="{{ __('Admin/site.workers') }}">{{ __('Admin/site.workers') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-item" href="{{ route('users.index') }}">
                                        <i class="icon-users"
                                            style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span
                                            data-i18n="{{ __('Admin/site.users') }}">{{ __('Admin/site.users') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End Admins & Moderators -->
                        <!-- Start Setting -->
                        <li>

                        </li>
                        <!-- End Setting -->
                    </ul>
                </li>
                <!-- End Dashboard Dropdown Menu -->
                <!-- Start Main Setting Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">tune</i>
                        <span class="menu-title" data-i18n="settings">
                            {{ trans('Admin/setting.page_title_in_sidebar') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Settings -->
                        <li>
                            <a class="menu-item" href="{{ route('settings') }}">
                                <i class="material-icons">tune</i>
                                <span data-i18n="settings">{{ trans('Admin/setting.page_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Settings -->
                        <!-- Start Sliders -->
                        <li>
                            <a class="menu-item" href="{{ route('sliders.index') }}">
                                <i class="material-icons">photo_library</i>
                                <span data-i18n="Sliders">{{ trans('Admin/sliders.sliderPageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Sliders -->
                        <!-- Start Payments -->
                        <li>
                            <a class="menu-item" href="{{ route('Payments.index') }}">
                                <i class="material-icons">payment</i>
                                <span data-i18n="Sliders">{{ trans('Admin/payments.paymentPageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Payments -->
                    </ul>
                </li>
                <!-- End Main Setting Dropdown Menu -->
                <!-- Start Countries Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">flag</i>
                        <span class="menu-title" data-i18n="Countries">
                            {{ trans('Admin/countries.country_title_in_sidebar') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Countries -->
                        <li>
                            <a class="menu-item" href="{{ route('Countries.index') }}">
                                <i class="material-icons">flag</i>
                                <span data-i18n="Countries">{{ trans('Admin/countries.countryPageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Countries -->
                        <!-- Start Proviences -->
                        <li>
                            <a class="menu-item" href="{{ route('Proviences.index') }}">
                                <i class="material-icons">flag</i>
                                <span
                                    data-i18n="Proviences">{{ trans('Admin/proviences.proviencePageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Proviences -->
                        <!-- Start Areas -->
                        <li>
                            <a class="menu-item" href="{{ route('Areas.index') }}">
                                <i class="material-icons">flag</i>
                                <span data-i18n="Areas">{{ trans('Admin/areas.areaPageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Areas -->
                        <!-- Start States -->
                        <li>
                            <a class="menu-item" href="{{ route('States.index') }}">
                                <i class="material-icons">flag</i>
                                <span data-i18n="States">{{ trans('Admin/states.statePageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End States -->
                        <!-- Start Villages -->
                        <li>
                            <a class="menu-item" href="{{ route('Villages.index') }}">
                                <i class="material-icons">flag</i>
                                <span data-i18n="Villages">{{ trans('Admin/villages.villagePageTitle') }}</span>
                            </a>
                        </li>
                        <!-- End Villages -->
                    </ul>
                </li>
                <!-- End Countries Dropdown Menu -->
                <!-- Start Department Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">account_balance</i>
                        <span class="menu-title"
                            data-i18n="Departments">{{ trans('Admin/departments.departments_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Department -->
                        <li>
                            <a class="menu-item" href="{{ route('Departments.index') }}">
                                <i class="material-icons"
                                    style="color: red;color: red;padding: 3px;font-size: 18px;">account_balance</i>
                                <span data-i18n="Departments">
                                    {{ trans('Admin/departments.departments_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Department -->
                    </ul>
                </li>
                <!-- End Department Dropdown Menu -->

                <!-- Start Category Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">account_balance</i>
                        <span class="menu-title"
                            data-i18n="Categories">{{ trans('Admin/categories.categories_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Category -->
                        <li>
                            <a class="menu-item" href="{{ route('Categories.index') }}">
                                <i class="material-icons"
                                    style="color: red;color: red;padding: 3px;font-size: 18px;">account_balance</i>
                                <span data-i18n="Categories">
                                    {{ trans('Admin/categories.categories_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Category -->
                    </ul>
                </li>
                <!-- Start Admin Department Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="icon-list info float-left"></i>

                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\site.admin_departments') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('AdminDepartments.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\site.admin_departments') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('AdminDepartments.create') }}"> <i class="material-icons">add</i><span
                                        data-i18n="Vertical">{{ __('Admin\site.add_admin_departments') }}</span></a>

                        </li>
                    </ul>
                </li>
                <!-- Start Admin Department Menu -->

                {{--start orchard--}}
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-tree  success"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\orchards.orchards_settings') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('LandCategories.index') }}">
                                                             <span
                                        data-i18n="Vertical">{{ __('Admin\site.land_category') }}</span></a>

                        </li>
                        <li><a class="menu-item" href="{{ route('TreeTypes.index') }}"><i
                                        class="material-icons"></i><span
                                        data-i18n="Vertical">{{ __('Admin\site.treeType') }}</span></a>

                        </li>
                        <li><a class="menu-item" href="{{ route('Trees.index') }}"><i
                                        class="material-icons"></i><span
                                        data-i18n="Vertical">{{ __('Admin\site.trees') }}</span></a>

                        </li>
                        <li><a class="menu-item" href="{{ route('orchards.index') }}"><i
                                        class="material-icons"></i><span
                                        data-i18n="Horizontal">{{ __('Admin\site.orchards') }}</span></a>

                        </li>
                    </ul>
                </li>
                {{--end orchard--}}

                <!-- start protected house Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-warehouse " style="color:deeppink;"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\p_houses.protectedHousePageTitle') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('ProtectedHouse.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\p_houses.protectedHousePageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end protected house Menu -->
                <!-- start Agriculture Services house Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-tractor" style="color:yellow;"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\services.farmer_agriculture_services_setting') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('AgricultureServices.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\services.agricultureServicePageTitle') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('AgricultureToolServices.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\services.agricultureToolServicePageTitle') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('WaterServices.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\services.waterServicePageTitle') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('FarmerServices.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\services.farmerServicePageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end Agriculture Services house Menu -->
                <!-- start precipitation  Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-cloud-showers-heavy" style="color:grey"></i>                                                {{-- <i class="icon-users warning font-large-2 float-right"></i> --}}
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\precipitations.precipitationsPageTitle') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('Precipitations.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\precipitations.precipitationsPageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end precipitation  Menu -->
                <!-- start Land Area  Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-adjust" style="color: bisque"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\land_areas.landAreaPageTitle') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('LandAreas.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\land_areas.landAreaPageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end Land Area  Menu -->
                <!-- start Land Area  Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-crop-simple " style="color:green;"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\crops.farmerCropsPageTitle_and_setting') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('FarmerCrops.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\crops.farmerCropsPageTitle') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('Crops.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\crops.cropPageTitle') }}</span></a>

                        </li>


                    </ul>
                </li>
                <!-- end Land Area  Menu -->

                <!-- start Animals Chicken Projecta Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-fish" style="color:yellow;"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\animals.animals_chiken_fish_PageTitle') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('Animals.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\animals.animalsPageTitle') }}</span></a>

                        </li>

                        <li>
                            <a class="menu-item" href="{{ route('Animals.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\animals.chickens_project') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end Animals   Menu -->

                <!-- start beekeepers & settings Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fab fa-forumbee" style="color:yellow"></i>
                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\bees.beekeepers_and_settings') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('BeeKeepers.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\bees.beekeeperPageTitle') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('BeeDisasters.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\bees.beesDisasterPageTitle') }}</span></a>

                        </li>

                        <li>
                            <a class="menu-item" href="{{ route('CourseBees.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\bees.courseBeesPageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end beekeepers & settings   Menu -->

                <!-- start WholeSale & settings Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-plane-arrival" style="color:blue;"></i>-
                        <i class="fas fa-plane-departure" style="color:blue;"></i>


                        <span class="menu-title"
                              data-i18n="Categories">{{ __('Admin\income_products.wholeSale_and_product') }}</span>
                    </a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('WholeSaleProducts.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\income_products.WholeProduct') }}</span></a>

                        </li>
                        <li>
                            <a class="menu-item" href="{{ route('IncomeProducts.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\income_products.income_productPageTitle') }}</span></a>

                        </li>

                        <li>
                            <a class="menu-item" href="{{ route('OutcomeProducts.index') }}"> <i class="material-icons">list</i><span
                                        data-i18n="Vertical">{{ __('Admin\outcome_products.outcome_productPageTitle') }}</span></a>

                        </li>

                    </ul>
                </li>
                <!-- end WholeSale & settings   Menu -->
                <!-- Start Department Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="icon-present " style="padding: 3px;font-size: 18px;"></i>
                        <span class="menu-title" data-i18n="Departments">{{ trans('Admin/site.blogstags') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start blog -->
                        <li>
                            <a class="menu-item" href="{{ route('blogs.index') }}">
                                <i class="icon-globe " style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                <span data-i18n="{{ trans('Admin/site.blog') }}"> {{ trans('Admin/site.blog') }}</span>
                            </a>
                        </li>
                        <!-- End blog -->
                        <!-- Start tag -->
                        <li>
                            <a class="menu-item" href="{{ route('tags.data') }}">
                                <i class="icon-speech" style="color: red;padding: 3px;font-size: 18px;"></i>
                                <span data-i18n="{{ trans('Admin/site.tag') }}"> {{ trans('Admin/site.tag') }}</span>
                            </a>
                        </li>
                        <!-- End tag -->
                    </ul>
                </li>

                <!-- Start Attributes Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">playlist_add_check</i>
                        <span class="menu-title" data-i18n="Attributes">
                            {{ trans('Admin/attributes.attributes_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Attributes -->
                        <li>
                            <a class="menu-item" href="{{ route('Attributes.index') }}">
                                <i class="material-icons">playlist_add_check</i>
                                <span data-i18n="Attributes">
                                    {{ trans('Admin/attributes.attributes_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Attributes -->
                    </ul>
                </li>
                <!-- End Attributes Dropdown Menu -->

                <!-- Start Product Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">grain</i>
                        <span class="menu-title" data-i18n="">
                            {{ trans('Admin/products.product_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Product -->
                        <li>
                            <a class="menu-item" href="{{ route('products') }}">
                                <i class="material-icons">grain</i>
                                <span data-i18n="products"> {{ trans('Admin/products.product_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Product -->
                    </ul>
                </li>
                <!-- End Product Dropdown Menu -->

                <!-- Start ProductCoupons Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">fiber_new</i>
                        <span class="menu-title" data-i18n="ProductCoupons">
                            {{ trans('Admin/coupons.coupon_title_in_sidebar') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start ProductCoupons -->
                        <li>
                            <a class="menu-item" href="{{ route('ProductCoupons.index') }}">
                                <i class="material-icons">fiber_new</i>
                                <span data-i18n="ProductCoupons">
                                    {{ trans('Admin/coupons.coupon_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End ProductCoupons -->
                    </ul>
                </li>
                <!-- End ProductCoupons Dropdown Menu -->

                <!-- Start options Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">credit_card</i>
                        <span class="menu-title" data-i18n="Options"> {{ trans('Admin/options.options_title') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start options -->
                        <li>
                            <a class="menu-item" href="{{ route('Options.index') }}">
                                <i class="material-icons">credit_card</i>
                                <span data-i18n="Options"> {{ trans('Admin/options.options_title') }}</span>
                            </a>
                        </li>
                        <!-- End options -->
                    </ul>
                </li>
                <!-- End options Dropdown Menu -->

                <!-- Start Orders Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span class="menu-title" data-i18n="Options"> {{ trans('Admin/orders.orders') }}</span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Orders -->
                        <li>
                            <a class="menu-item" href="{{ route('Orders.index') }}">
                                <i class="material-icons">add_shopping_cart</i>
                                <span data-i18n="Options"> {{ trans('Admin/orders.order_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Orders -->
                    </ul>
                </li>
                <li class=" nav-item">
                        <li>
                            <a class="menu-item" href="{{ route('subscribe') }}">
                                <i class="fas fa-dragon"></i>
                                <span data-i18n="Options"> {{ trans('Admin/site.sub') }}</span>
                            </a>
                        </li>
                        <!-- End Orders -->
                </li>
                <!-- End Orders Dropdown Menu -->

                <!-- Start Contact Us -->
                <li class=" nav-item">
                        <li>
                            <a class="menu-item" href="{{ route('contact_us') }}">
                                <i class="material-icons"> mail_outline </i>
                                <span data-i18n="Options"> {{ trans('Admin/site.contact') }}</span>
                            </a>
                        </li>
                        <!-- End Orders -->
                </li>
                <!-- End Contact Us  -->


                <!-- Start Contact Us -->
                <li class=" nav-item">
                    <li>
                        <a class="menu-item" href="{{ route('review.index') }}">
                            <i class="material-icons"> mail_outline </i>
                            <span data-i18n="Options"> {{ trans('Admin/site.reviwe') }}</span>
                        </a>
                    </li>
                    <!-- End Orders -->
                </li>
                <!-- End Contact Us  -->
                
            </ul>
        </div>
    </div>
</div>


<!-- END: Main Menu-->
