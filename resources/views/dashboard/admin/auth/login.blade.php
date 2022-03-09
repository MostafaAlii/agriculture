{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('admin.login.post') }}">

            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('pageTitle')</title>



    <link rel="apple-touch-icon" href="{{ asset('assets/admin/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/material-icons/material-icons.css') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/material-vendors-rtl.min.css') }}">
    <!-- END: Vendor CSS-->
    @if(app()->getLocale()=='ar')
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material-colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/custom-rtl.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/menu-types/material-vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/style-rtl.css') }}">

    @else

    <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material-colors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/menu/menu-types/material-vertical-menu.css') }}">

    @endif


    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/charts/apexcharts.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- END: Custom CSS-->
    {{-- @yield('css') --}}

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  bg-full-screen-image blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                <div class="card-header border-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/admin/images/logo/logo-dark.png') }}" alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2"><span>Easily Using</span></h6>
                                </div>
                                <div class="card-content">
                                    <div class="text-center">
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"><span class="la la-facebook"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter"><span class="la la-twitter"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-linkedin"><span class="la la-linkedin font-medium-4"></span></a>
                                        <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-github"><span class="la la-github font-medium-4"></span></a>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>OR Using Account
                                            Details</span></p>
                                    <div class="card-body">
                                        <form class="form-horizontal"  novalidate method="POST" action="{{ route('admin.login.post') }}" >
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input  class="form-control" id="user-name" placeholder="Your Email"
                                                type="email" name="email" :value="old('email')" required autofocus >
                                                <div class="form-control-position">
                                                    <i class="la la-user"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input class="form-control" id="user-password" placeholder="Enter Password"
                                                type="password"
                                                name="password"
                                                required autocomplete="current-password">
                                                <div class="form-control-position">
                                                    <i class="la la-key"></i>
                                                </div>
                                            </fieldset>
                                            <div class="form-group row">
                                                <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                                    <fieldset>
                                                        <input type="checkbox" id="remember-me" class="chk-remember" name="remember">
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                                        </form>
                                    </div>
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1"><span>New to Modern
                                            ?</span></p>
                                    <div class="card-body">
                                        <a href="register-with-bg-image.html" class="btn btn-outline-danger btn-block"><i class="la la-user"></i>
                                            Register</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/admin/vendors/js/material-vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('assets/admin/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/admin/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/admin/js/scripts/pages/material-app.js') }}"></script>
    <script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}"></script>

</body>
<!-- END: Body-->

</html>
