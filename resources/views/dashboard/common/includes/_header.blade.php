<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light bg-primary navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="flex-row nav navbar-nav">
                <li class="mr-auto nav-item mobile-menu d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">

                        @if(app()->getLocale()=='ar')
                            <img class="img-logo img-fluid lazy" src="{{setting()->ar_site_logo ?
                             URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo):
                             URL::asset('Dashboard/img/Default/logo_ar.png')}}"
                                width="50" height="50"  alt="demo"  style="left: 45%;    width: 50px;height: 50px;"/>
                        @elseif(app()->getLocale()=='ku')
                            <img class="img-logo img-fluid lazy" src="{{setting()->ku_site_logo ?
                             URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo):
                             URL::asset('Dashboard/img/Default/logo_ku.png')}}"
                                 width="50" height="50"  alt="demo"  style="left: 45%;    width: 50px;height: 50px;"/>
                        @elseif(app()->getLocale()=='en')
                            <img class="img-logo img-fluid lazy" src="{{setting()->en_site_logo ?
                             URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo):
                             URL::asset('Dashboard/img/Default/logo_en.png')}}"
                                 width="50" height="50"  alt="demo"  style="left: 45%;    width: 50px;height: 50px;"/>
                        @endif
                        <h5 class="brand-text">
                            {{ ucfirst(setting()->site_name) }}
                        </h5>
                    </a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="material-icons mt-50">more_vert</i></a></li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="float-left mr-auto nav navbar-nav">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle" href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="float-right nav navbar-nav">
                    <li class="">
                        <div class="dropdown nav-itemd-none d-md-flex">
                            <a href="#" class="pl-0 d-flex nav-item nav-link country-flag1" data-toggle="dropdown"
                               aria-expanded="false">
                                @if (App::getLocale() == 'ar')
                                    <strong class="my-auto ml-2 mr-2">
                                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                                    </strong>
                                @elseif(App::getLocale() == 'ku')
                                    {{ LaravelLocalization::getCurrentLocaleNative() }}
                                @else
                                    <strong class="my-auto ml-2 mr-2">
                                        {{ LaravelLocalization::getCurrentLocaleNative() }}
                                    </strong>
                                @endif
                                <div class="my-auto">
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </li>

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"><span class="mr-1 user-name text-bold-700">
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span><span class="avatar avatar-online">
                                @if(isset(Auth::user()->image->filename))
                                    <img src="{{ asset('Dashboard/img/admins/'. Auth::user()->image->filename) }}"
                                         alt="{{ asset('Dashboard/img/admins/'. Auth::user()->image->filename) }}">
                                @else
                                    <img src="{{ asset('Dashboard/img/admins/avatar.jpg') }}"
                                         alt="{{ asset('Dashboard/img/admins/avatar.jpg') }}">
                                @endif

                                <i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            {{-- route to go website ******************************************** --}}
                            <a class="dropdown-item" href="{{ route('home.admin') }}" target="_blank">
                                <i class="material-icons">public</i>
                                {{ trans('Admin/dashboard.website') }}
                            </a>
                            {{-- route to go website ******************************************** --}}
                            <a class="dropdown-item" href="{{ route('profile.index') }}" >
                                <i class="material-icons">person_outline</i>
                                @lang('Admin/site.profile')
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout.admin') }}"
                               onclick="event.preventDefault(); document.getElementById('log-out').submit();"
                            ><i class="material-icons">power_settings_new</i>
                                @lang('Admin/site.logout')
                            </a>
                        </div>
                    </li>
                    <form id="log-out" action="{{ route('logout.admin') }}" method="POST">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
