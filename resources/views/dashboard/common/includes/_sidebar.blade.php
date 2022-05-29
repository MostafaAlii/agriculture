<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <div class="user-profile">
            <div class="user-info text-center pt-1 pb-1">
                @if (isset(Auth::user()->image->filename))
                <a class="mr-2" href="{{ route('profile.index') }}">
                    <img class="user-img img-fluid rounded-circle" style="width:50%; height:50%;border-radius: 15%;" class="rounded-circle" src="{{ asset('Dashboard/img/admins/' . Auth::user()->image->filename) }}" />
                </a>
                @else
                <a class="mr-2" href="{{ route('profile.index') }}">
                    <img class="user-img img-fluid rounded-circle" src="{{ asset('Dashboard/img/admins/avatar.jpg') }}" />
                </a>
                @endif
                <div class="name-wrapper d-block dropdown text-center">
                    <a class="white dropdown-toggle ml-2" id="user-account" href="{{ route('profile.index') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="user-name">{{
                            Auth::user()->firstname }}
                            {{ Auth::user()->lastname }}</span></a>
                    <div class="text-light text-center">
                        {{ Auth::user()->type == 'admin' ? __('Admin/site.admins') : __('Admin/site.employee') }}
                    </div>
                    <div class="dropdown-menu arrow" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">
                            <i class="material-icons align-middle mr-1">person</i>
                            <span class="align-middle">{{ trans('Admin/site.profile') }}</span>
                        </a>
                        <a class="dropdown-item" href="{{ route('logout.admin') }}" onclick="event.preventDefault(); document.getElementById('log-out').submit();">
                            <i class="material-icons">power_settings_new</i>
                            @lang('Admin/site.logout')
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Main Content -->
        <div class="main-menu-content">
            <!-- Start Navigations UL -->
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- Start Dashboard Dropdown Menu -->
                @can('dashboard')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">assessment</i>
                            <span class="menu-title" data-i18n="Dashboard">{{ trans('Admin/setting.dashboard') }}</span>
                        </a>
                        @can('moderators-management')
                            <ul class="menu-content">
                                <!-- Start Admins & Moderators -->
                                <li>
                                    <a class="menu-item" href="#">
                                        <i class="icon-user" style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span data-i18n="Vertical">{{ trans('Admin\admins.admins') }}</span>
                                    </a>
                                    <ul class="menu-content">
                                        @can('moderator-list')
                                            <!-- Start Admin -->
                                            <li>
                                                <a class="menu-item" href="{{ route('Admins.index') }}">
                                                    <i class="icon-badge" style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                                    <span data-i18n="{{ trans('Admin\admins.admin') }}">{{
                                                        trans('Admin\admins.admin') }}</span>
                                                </a>
                                            </li>
                                            <!-- End Admin -->
                                        @endcan
                                        @can('farmer-list')
                                        <!-- Start Farmer -->
                                        <li>
                                            <a class="menu-item" href="{{ route('farmers.index') }}">
                                                <i class="icon-user-follow" style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                                <span data-i18n="{{ __('Admin/site.farmer') }}">{{ __('Admin/site.farmer')
                                                    }}</span>
                                            </a>
                                        </li>
                                        <!-- End Farmer -->
                                        @endcan
                                        @can('worker-list')
                                        <!-- Start Worker -->
                                        <li>
                                            <a class="menu-item" href="{{ route('workers.index') }}">
                                                <i class="icon-user-follow" style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                                <span data-i18n="{{ __('Admin/site.workers') }}">{{ __('Admin/site.workers')
                                                    }}</span>
                                            </a>
                                        </li>
                                        <!-- End Worker -->
                                        @endcan
                                        @can('vendor-list')
                                        <!-- Start Vendor -->
                                        <li>
                                            <a class="menu-item" href="{{ route('users.index') }}">
                                                <i class="icon-users" style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                                <span data-i18n="{{ __('Admin/site.users') }}">{{ __('Admin/site.users')
                                                    }}</span>
                                            </a>
                                        </li>
                                        <!-- End Vendor -->
                                        @endcan
                                    </ul>
                                </li>
                                <!-- End Admins & Moderators -->
                            </ul>
                        @endcan
                    </li>
                @endcan
                <!-- End Dashboard Dropdown Menu -->
                <!-- Start Main Setting Dropdown Menu -->
                @can('settings-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">tune</i>
                            <span class="menu-title" data-i18n="settings">
                                {{ trans('Admin/site.settings') }}
                            </span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Roles Permissions -->
                            @can('role-list')
                                <li>
                                    <a class="menu-item" href="{{ route('Roles.index') }}">
                                        <i class="material-icons">flash_on</i>
                                        <span data-i18n="Roles"> {{ trans('Admin/roles.role_title_in_sidebar') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Roles Permissions -->
                            <!-- Start Transactions settings -->
                                @can('transaction-managment')
                                <li>
                                    <a class="menu-item" href="#">
                                        <i class="material-icons">swap_calls</i> 
                                        <span data-i18n="Vertical"> {{ trans('Admin\setting.transaction_setting') }} </span>
                                    </a>
                                    <ul class="menu-content">
                                        @can('currencies')
                                            <li>
                                                <a class="menu-item" href="{{ route('Currencies.index') }}">
                                                    <i class="material-icons">attach_money</i>  
                                                    <span data-i18n="Currencies"> {{ trans('Admin/setting.currency_title_in_sidebar') }} </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can('units')
                                            <li>
                                                <a class="menu-item" href="{{ route('Units.index') }}">
                                                    <i class="material-icons">ac_unit</i>  
                                                    <span data-i18n="Units"> {{ trans('Admin/setting.unit_title_in_sidebar') }} </span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>        
                                </li>
                            @endcan
                            <!-- End Transactions settings -->
                            <!-- Start Pages -->
                            @can('pages')
                                <li>
                                    <a class="menu-item" href="#">
                                        <i class="material-icons">pages</i>
                                        <span data-i18n="Vertical">{{ trans('Admin\site.pages') }}</span>
                                    </a>
                                    <ul class="menu-content">
                                        <!-- Start Setting -->
                                        @can('settings')
                                            <li>
                                                <a class="menu-item" href="{{ route('settings') }}">
                                                    <i class="material-icons">tune</i>
                                                    <span data-i18n="settings"> {{ trans('Admin/site.settings') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Setting -->
                                        <!-- Start AboutUs -->
                                        @can('about-us')
                                            <li>
                                                <a class="menu-item" href="{{ route('about_us/show') }}">
                                                    <i class="material-icons"> info </i>
                                                    <span data-i18n="Options"> {{ trans('Admin/site.about_us') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End AboutUs -->
                                        <!-- Start Contact Us -->
                                        @can('contact-us')
                                            <li>
                                                <a class="menu-item" href="{{ route('contact_us') }}">
                                                    <i class="material-icons"> mail_outline </i>
                                                    <span data-i18n="Options"> {{ trans('Admin/site.contact') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Contact Us -->
                                        <!-- Start Teams -->
                                        @can('team-managment')
                                            <li>
                                                <a class="menu-item" href="{{ route('team.index') }}">
                                                    <i class="icon-user" style="color: whight;;padding: 3px;font-size: 18px;"></i>
                                                    <span data-i18n="Options"> {{ trans('Admin/site.our_team') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Teams -->
                                        <!-- Start Review -->
                                        @can('client-review')
                                            <li>
                                                <a class="menu-item" href="{{ route('review.index') }}">
                                                    <i class="material-icons"> mail_outline </i>
                                                    <span data-i18n="Options"> {{ trans('Admin/site.reviwe') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Review -->
                                        <!-- Start Slider -->
                                        @can('slider-managment')
                                            <li>
                                                <a class="menu-item" href="{{ route('sliders.index') }}">
                                                    <i class="material-icons">photo_library</i>
                                                    <span data-i18n="Sliders"> {{ trans('Admin/site.sliderimages') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Slider -->
                                        <!-- Start Brand -->
                                        @can('brands-managment')
                                            <li>
                                                <a class="menu-item" href="{{ route('brands.index') }}">
                                                    <i class="material-icons">photo_library</i>
                                                    <span data-i18n="Brands"> {{ trans('Admin/site.brand') }}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        <!-- End Brand -->
                                    </ul>
                                </li>
                            @endcan
                            <!-- End Pages --> 
                        </ul> 
                    </li>
                @endcan
                <!-- End Settings -->
                <!-- End Main Setting Dropdown Menu -->
                <!-- Start Countries Dropdown Menu -->
                @can('countries-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">flag</i>
                            <span class="menu-title" data-i18n="Countries">
                                {{ trans('Admin/countries.country_title_in_sidebar') }}
                            </span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Countries -->
                            @can('country-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Countries.index') }}">
                                        <i class="material-icons">flag</i>
                                        <span data-i18n="Countries">{{ trans('Admin/countries.countryPageTitle') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Countries -->
                            <!-- Start Proviences -->
                            @can('provience-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Proviences.index') }}">
                                        <i class="material-icons">flag</i>
                                        <span data-i18n="Proviences">{{ trans('Admin/proviences.proviencePageTitle') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Proviences -->
                            <!-- Start Areas -->
                            @can('area-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Areas.index') }}">
                                        <i class="material-icons">flag</i>
                                        <span data-i18n="Areas">{{ trans('Admin/areas.areaPageTitle') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Areas -->
                            <!-- Start States -->
                            @can('state-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('States.index') }}">
                                        <i class="material-icons">flag</i>
                                        <span data-i18n="States">{{ trans('Admin/states.statePageTitle') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End States -->
                            <!-- Start Villages -->
                            @can('village-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Villages.index') }}">
                                        <i class="material-icons">flag</i>
                                        <span data-i18n="Villages">{{ trans('Admin/villages.villagePageTitle') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Villages -->
                        </ul>
                    </li>
                @endcan
                <!-- End Countries Dropdown Menu -->
                <!-- Start Department Dropdown Menu -->
                @can('department-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">account_balance</i>
                            <span class="menu-title" data-i18n="Departments">{{
                                trans('Admin/departments.departments_title_in_sidebar') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Department -->
                            @can('department-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Departments.index') }}">
                                        <i class="material-icons" style="color: red;color: red;padding: 3px;font-size: 18px;">account_balance</i>
                                        <span data-i18n="Departments">
                                            {{ trans('Admin/departments.departments_title_in_sidebar') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Department -->
                        </ul>
                    </li>
                @endcan
                <!-- End Department Dropdown Menu -->

                <!-- Start Category Dropdown Menu -->
                @can('category-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">account_balance</i>
                            <span class="menu-title" data-i18n="Categories">{{
                                trans('Admin/categories.categories_title_in_sidebar') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Category -->
                            @can('category-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('Categories.index') }}">
                                        <i class="material-icons" style="color: red;color: red;padding: 3px;font-size: 18px;">account_balance</i>
                                        <span data-i18n="Categories">
                                            {{ trans('Admin/categories.categories_title_in_sidebar') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Category -->
                        </ul>
                    </li>
                @endcan
                <!-- End Category Dropdown Menu -->
                <!-- Start Admin Department Menu -->
                @can('admin-department-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="icon-list info float-left"></i>
                            <span class="menu-title" data-i18n="Categories">{{ __('Admin\site.admin_departments') }}</span>
                        </a>
                        <ul class="menu-content">
                            @can('admin-department-create')
                                <li>
                                    <a class="menu-item" href="{{ route('AdminDepartments.create') }}"> <i class="material-icons">add</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\site.add_admin_departments') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('admin-department-managment')
                                <li>
                                    <a class="menu-item" href="{{ route('AdminDepartments.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\site.admin_departments') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- End Admin Department Menu -->

                {{-- start orchard --}}
                @can('orchards-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-tree  success"></i>
                            <span class="menu-title" data-i18n="Categories">{{ __('Admin\orchards.orchards_settings') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Land Category -->
                            @can('land-categories')
                                <li>
                                    <a class="menu-item" href="{{ route('LandCategories.index') }}">
                                        <span data-i18n="Vertical">{{ __('Admin\site.land_category') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Land Category -->
                            <!-- Start TreeTypes -->
                            @can('tree-type')
                                <li>
                                    <a class="menu-item" href="{{ route('TreeTypes.index') }}">
                                        <i class="material-icons"></i>
                                        <span data-i18n="Vertical">{{ __('Admin\site.treeType') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End TreeTypes -->
                            <!-- Start Trees -->
                            @can('tree')
                                <li>
                                    <a class="menu-item" href="{{ route('Trees.index') }}">
                                        <i class="material-icons"></i>
                                        <span data-i18n="Vertical">{{ __('Admin\site.trees') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Trees -->
                            <!-- Start Orchards -->
                            @can('orchard')
                                <li>
                                    <a class="menu-item" href="{{ route('orchards.index') }}">
                                        <i class="material-icons"></i>
                                        <span data-i18n="Horizontal">{{ __('Admin\site.orchards') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- Start Orchards -->
                        </ul>
                    </li>
                @endcan
                {{-- end orchard --}}

                <!-- start protected house Menu -->
                @can('protect-house-list')
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="fas fa-warehouse " style="color:deeppink;"></i>
                        <span class="menu-title" data-i18n="Categories">
                            {{ __('Admin\p_houses.protectedHousePageTitle')}}
                        </span>
                    </a>
                    <ul class="menu-content">
                        @can('protect-house')
                        <li>
                            <a class="menu-item" href="{{ route('ProtectedHouse.index') }}"> <i class="material-icons">list</i>
                                <span data-i18n="Vertical">
                                    {{__('Admin\p_houses.protectedHousePageTitle') }}
                                </span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!-- end protected house Menu -->

                <!-- start Agriculture Services house Menu -->
                @can('service-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-tractor" style="color:yellow;"></i>
                            <span class="menu-title" data-i18n="Categories">{{
                                __('Admin\services.farmer_agriculture_services_setting') }}</span>
                        </a>
                        <ul class="menu-content">
                            @can('agriculture-service')
                                <li>
                                    <a class="menu-item" href="{{ route('AgricultureServices.index') }}"> <i class="material-icons">list</i><span data-i18n="Vertical">{{
                                            __('Admin\services.agricultureServicePageTitle') }}</span></a>
                                </li>
                            @endcan
                            @can('agriculture-tools-service')
                                <li>
                                    <a class="menu-item" href="{{ route('AgricultureToolServices.index') }}"> <i class="material-icons">list</i><span data-i18n="Vertical">{{
                                            __('Admin\services.agricultureToolServicePageTitle') }}</span></a>
                                </li>
                            @endcan
                            @can('water-service')
                                <li>
                                    <a class="menu-item" href="{{ route('WaterServices.index') }}"> <i class="material-icons">list</i><span data-i18n="Vertical">{{
                                            __('Admin\services.waterServicePageTitle') }}</span></a>
                                </li>
                            @endcan
                            @can('farmer-service')
                                <li>
                                    <a class="menu-item" href="{{ route('FarmerServices.index') }}"> <i class="material-icons">list</i><span data-i18n="Vertical">{{
                                            __('Admin\services.farmerServicePageTitle') }}</span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- end Agriculture Services house Menu -->

                <!-- start precipitation  Menu -->
                @can('precipitation-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-cloud-showers-heavy" style="color:grey"></i> {{-- <i
                                class="icon-users warning font-large-2 float-right"></i> --}}
                            <span class="menu-title" data-i18n="Categories">{{
                                __('Admin\precipitations.precipitationsPageTitle') }}</span>
                        </a>
                        <ul class="menu-content">
                            @can('precipitation')
                                <li>
                                    <a class="menu-item" href="{{ route('Precipitations.index') }}"> <i class="material-icons">list</i><span data-i18n="Vertical">{{
                                            __('Admin\precipitations.precipitationsPageTitle') }}</span></a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- end precipitation  Menu -->

                <!-- start Land Area  Menu -->
                @can('land-area-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-adjust" style="color: bisque"></i>
                            <span class="menu-title" data-i18n="Categories">
                                {{ __('Admin\land_areas.landAreaPageTitle')}}
                            </span>
                        </a>
                        <ul class="menu-content">
                            @can('land-area')
                                <li>
                                    <a class="menu-item" href="{{ route('LandAreas.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\land_areas.landAreaPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- end Land Area  Menu -->

                <!-- start FarmerCrops  Menu -->
                @can('farmer-crop-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-crop-simple " style="color:green;"></i>
                            <span class="menu-title" data-i18n="Categories">{{
                                __('Admin\crops.farmerCropsPageTitle_and_setting') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Farmer Crop -->
                            @can('farmer-crop')
                            <li>
                                <a class="menu-item" href="{{ route('FarmerCrops.index') }}"> <i class="material-icons">list</i>
                                    <span data-i18n="Vertical">
                                        {{__('Admin\crops.farmerCropsPageTitle') }}
                                    </span>
                                </a>
                            </li>
                            @endcan
                            <!-- End Farmer Crop -->
                            <!-- Start Winter Crop -->
                            @can('winter-crops')
                                <li>
                                    <a class="menu-item" href="{{ route('WinterCrops.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\crops.winter_cropPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Winter Crop -->
                            <!-- Start Summer Crop -->
                            @can('summer-crops')
                                <li>
                                    <a class="menu-item" href="{{ route('SummerCrops.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\crops.summer_cropPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Summer Crop -->
                        </ul>
                    </li>
                @endcan
                <!-- end FarmerCrops  Menu -->

                <!-- start Animals Chicken Project Menu -->
                @can('projects-list')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-fish" style="color:yellow;"></i>
                            <span class="menu-title" data-i18n="Categories">
                                {{ __('Admin\animals.animals_chiken_fish_PageTitle')}}
                            </span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Caws & Fish Project -->
                            @can('caws-project')
                                <li>
                                    <a class="menu-item" href="{{ route('Animals.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\animals.animalsPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Caws & Fish Project -->
                            <!-- Start Chicken Project -->
                            @can('chicken-project')
                                <li>
                                    <a class="menu-item" href="{{ route('Chickens.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\animals.chickens_project') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Chicken Project -->
                        </ul>
                    </li>
                @endcan
                <!-- end Animals   Menu -->

                <!-- start beekeepers & settings Menu -->
                @can('bee-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fab fa-forumbee" style="color:yellow"></i>
                            <span class="menu-title" data-i18n="Categories">{{ __('Admin\bees.beekeepers_and_settings')
                                }}</span>
                        </a>
                        <ul class="menu-content">
                            @can('bee-keepers')
                                <li>
                                    <a class="menu-item" href="{{ route('BeeKeepers.index') }}"> <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{__('Admin\bees.beekeeperPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('bee-disasters')
                                <li>
                                    <a class="menu-item" href="{{ route('BeeDisasters.index') }}"> 
                                        <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\bees.beesDisasterPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('bee-courses')
                                <li>
                                    <a class="menu-item" href="{{ route('CourseBees.index') }}">
                                        <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\bees.courseBeesPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- end beekeepers & settings   Menu -->

                <!-- start WholeSale & settings Menu -->
                @can('whole-products-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="fas fa-plane-arrival" style="color:blue;"></i>-
                            <i class="fas fa-plane-departure" style="color:blue;"></i>
                            <span class="menu-title" data-i18n="Categories">
                                {{ __('Admin\income_products.wholeSale_and_product')}}
                            </span>
                        </a>
                        <ul class="menu-content">
                            @can('whole-sale-products')
                                <li>
                                    <a class="menu-item" href="{{ route('WholeSaleProducts.index') }}"> 
                                        <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\income_products.WholeProduct') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('income-products')
                                <li>
                                    <a class="menu-item" href="{{ route('IncomeProducts.index') }}"> 
                                        <i class="material-icons">list</i>
                                        <span data-i18n="Vertical">
                                            {{ __('Admin\income_products.income_productPageTitle') }}
                                        </span>
                                    </a>
                                </li>
                            @endcan
                            @can('outcome-products')
                            <li>
                                <a class="menu-item" href="{{ route('OutcomeProducts.index') }}"> 
                                    <i class="material-icons">list</i><span data-i18n="Vertical">
                                        {{ __('Admin\outcome_products.outcome_productPageTitle') }}
                                    </span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                <!-- end WholeSale & settings   Menu -->

                <!-- Start Bolgs Dropdown Menu -->
                @can('blogs-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="icon-present " style="padding: 3px;font-size: 18px;"></i>
                            <span class="menu-title" data-i18n="Blogs">{{ trans('Admin/site.blogstags') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start blog -->
                            @can('blogs')
                                <li>
                                    <a class="menu-item" href="{{ route('blogs.index') }}">
                                        <i class="icon-globe " style="color: red;color: red;padding: 3px;font-size: 18px;"></i>
                                        <span data-i18n="{{ trans('Admin/site.blog') }}">
                                            {{ trans('Admin/site.blog') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End blog -->
                            <!-- Start tag -->
                            @can('tags')
                                <li>
                                    <a class="menu-item" href="{{ route('tags.data') }}">
                                        <i class="icon-speech" style="color: red;padding: 3px;font-size: 18px;"></i>
                                        <span data-i18n="{{ trans('Admin/site.tag') }}">
                                            {{ trans('Admin/site.tag') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End tag -->
                        </ul>
                    </li>
                @endcan
                <!-- End Bolgs Dropdown Menu -->

                <!-- Start Attributes Dropdown Menu -->
                @can('attributes-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">playlist_add_check</i>
                            <span class="menu-title" data-i18n="Attributes">
                                {{ trans('Admin/attributes.attributes_title_in_sidebar') }}</span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start Attributes -->
                            @can('attributes')
                                <li>
                                    <a class="menu-item" href="{{ route('Attributes.index') }}">
                                        <i class="material-icons">playlist_add_check</i>
                                        <span data-i18n="Attributes">
                                            {{ trans('Admin/attributes.attributes_title_in_sidebar') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End Attributes -->
                        </ul>
                    </li>
                @endcan
                <!-- End Attributes Dropdown Menu -->

                <!-- Start Product Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">grain</i>
                        <span class="menu-title" data-i18n="">
                            {{ trans('Admin/products.product_title_in_sidebar') }}
                        </span>
                    </a>
                    <ul class="menu-content">
                        <!-- Start Product -->
                        <li>
                            <a class="menu-item" href="{{ route('products') }}">
                                <i class="material-icons">grain</i>
                                <span data-i18n="products">
                                    {{ trans('Admin/products.product_title_in_sidebar') }}</span>
                            </a>
                        </li>
                        <!-- End Product -->
                    </ul>
                </li>
                <!-- End Product Dropdown Menu -->

                <!-- Start options Dropdown Menu -->
                @can('options-managment')
                    <li class=" nav-item">
                        <a href="{{-- route('admin.dashboard') --}}">
                            <i class="material-icons">credit_card</i>
                            <span class="menu-title" data-i18n="Options">
                                {{ trans('Admin/options.options_title') }}
                            </span>
                        </a>
                        <ul class="menu-content">
                            <!-- Start options -->
                            @can('options')
                                <li>
                                    <a class="menu-item" href="{{ route('Options.index') }}">
                                        <i class="material-icons">credit_card</i>
                                        <span data-i18n="Options"> {{ trans('Admin/options.options_title') }}</span>
                                    </a>
                                </li>
                            @endcan
                            <!-- End options -->
                        </ul>
                    </li>
                @endcan
                <!-- End options Dropdown Menu -->

                <!-- Start Orders Dropdown Menu -->
                <li class=" nav-item">
                    <a href="{{-- route('admin.dashboard') --}}">
                        <i class="material-icons">add_shopping_cart</i>
                        <span class="menu-title" data-i18n="Orders"> {{ trans('Admin/orders.orders') }}</span>
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
                <!-- End Orders Dropdown Menu -->

                <!-- Start Subscriptions -->
                <li class=" nav-item">
                    <li>
                        <a class="menu-item" href="{{ route('subscribe') }}">
                            <i class="fas fa-dragon"></i>
                            <span data-i18n="Options"> {{ trans('Admin/site.sub') }}</span>
                        </a>
                    </li>
                <!-- End Orders -->
                </li>
                <!-- Start Subscriptions -->
            </ul>
            <!-- End Navigations UL -->
        </div>
        <!-- End Main Content -->
    </div>
</div>
<!-- END: Main Menu-->
