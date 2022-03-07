{{-- @extends('front.layouts.master') --}}
@extends('front.layoutsShop.master3')
@section('title', 'User login page ')
@section('css')

@endsection
@section('content')
    <!-- start section -->

<!-- start section -->
<section class="section">
    <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
        <img class="lazy" width="286" height="280" src="img/blank.gif" data-src="img/decor-el_1.jpg" alt="demo"/>
    </div>

    <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
        <img class="lazy" width="115" height="117" src="img/blank.gif" data-src="img/decor-el_3.jpg" alt="demo"/>
    </div>

    <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
        <img class="lazy" width="84" height="76" src="img/blank.gif" data-src="img/decor-el_4.jpg" alt="demo"/>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                <h2>Sign <span>in</span></h2>

                <!-- start form -->
                <form class="auth-form" name="form-login" method="POST" action="{{ route('User.login.post') }}">
                    @csrf
                    <div class="input-wrp">
                        <input id="email" class="textfield" type="email" name="email" :value="old('email')" required autofocus placeholder=" email address *" />
                    </div>

                    <div class="input-wrp">
                        <input class="textfield" type="password"
                        name="password" id="password"
                        required autocomplete="current-password" placeholder="Password" />
                    </div>

                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <label class="checkfield align-bottom">
                                <input type="checkbox" checked="">
                                <i></i>
                                Remember me
                            </label>
                        </div>

                        <div class="col-auto">
                            <a class="link-forgot" href="#">Lost your password?</a>
                        </div>
                    </div>

                    <div class="d-table mt-8">
                        <div class="d-table-cell align-middle">
                            <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Login in</button>
                        </div>

                        <div class="d-table-cell align-middle">
                            <a class="link-to" href="#">Sign up</a>
                        </div>
                    </div>
                </form>
                <!-- end form -->

                <div class="spacer py-6 d-md-none"></div>

            </div>

            <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                <h2>Sign <span>Up</span></h2>

                <!-- start form -->
                <form class="auth-form" action="#">
                    <div class="input-wrp">
                        <input class="textfield" type="text" placeholder="Full name *" />
                    </div>

                    <div class="input-wrp">
                        <input class="textfield" type="text" placeholder="Email *" />
                    </div>

                    <div class="input-wrp">
                        <input class="textfield" type="text" placeholder="Password" />
                    </div>

                    <div class="input-wrp">
                        <input class="textfield" type="text" placeholder="Confirm password" />
                    </div>

                    <div class="d-table mt-8">
                        <div class="d-table-cell align-middle">
                            <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">Sign up</button>
                        </div>

                        <div class="d-table-cell align-middle">
                            <a class="link-to" href="#">Sign in</a>
                        </div>
                    </div>
                </form>
                <!-- end form -->
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

@endsection
@push('js')

@endpush
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

        <form method="POST" action="{{ route('farmer.login.post') }}">

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




