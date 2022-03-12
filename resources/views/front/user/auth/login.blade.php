{{-- @extends('front.layouts.master') --}}
@extends('front.layouts.master4')
@section('title', 'login page ')
@section('css')
    <style>
        .panel {
            display: none;
        }

    </style>
@endsection
@section('content')
    <!-- start section -->

    <!-- start section -->
    <section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('img/decor-el_1.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('img/decor-el_3.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('img/decor-el_4.jpg') }}" alt="demo" />
        </div>

        <div class="container">
            <div class="raw">
                <div class="col-md-12">
                    <div class="form-group">
                        <h2><label for="">{{ trans('Admin/site.yourtype') }}</label></h2>
                        <select name="" id="sectionselect" class="custom-btn custom-btn--medium custom-btn--style-2">
                            <option class="custom-btn custom-btn--style-2" value="" selected disabled>--- {{ trans('Admin/site.select') }}---
                            </option>
                            <option class="custom-btn custom-btn--medium custom-btn--style-2" value="user">{{ trans('Admin/site.user') }}</option>
                            <option class="custom-btn custom-btn--medium custom-btn--style-2" value="farmer">{{ trans('Admin/site.farmer') }}</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- form user --}}
            <div class="panel" id="user">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <h2>{{ trans('Admin/site.signvendor') }}</h2>
                        @include('dashboard.common._partials.messages')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- start user login form -->
                        <form class="auth-form" name="form-login" method="POST" action="{{ route('User.login') }}">
                            @csrf
                            <div class="input-wrp">
                                <input id="login" class="textfield" type="login" name="login"
                                    required autofocus placeholder=" {{ trans('Admin/site.loginby') }}" />
                            </div>
                            @error('login')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="input-wrp">
                                <input class="textfield" type="password" name="password" id="password" required
                                    autocomplete="current-password" placeholder="{{ trans('Admin/site.password') }}" />
                            </div>
                            @error('password')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
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
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">{{ trans('Admin/site.login') }}</button>
                                </div>

                                {{-- <div class="d-table-cell align-middle">
                                <a class="link-to" href="#">Sign up</a>
                            </div> --}}
                            </div>
                        </form>
                        <!-- end user login form -->

                        <div class="spacer py-6 d-md-none"></div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                        <h2>{{ trans('Admin/site.newvendor') }}</h2>
                        {{-- @include('dashboard.common._partials.messages') --}}
                        <!-- start form -->
                        <form class="auth-form" action="{{ route('user.register.post') }}" method="post">
                            @csrf
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.firstname') }}" name="firstname" />
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.lastname') }}" name="lastname" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="email" placeholder="{{ trans('Admin/site.email') }}" name="email" />
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.phone') }}" name="phone" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password') }}" name="password" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password_confirmation') }}"
                                    name="password_confirmation" />
                            </div>

                            <div class="d-table mt-8">
                                <div class="d-table-cell align-middle">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">{{ trans('Admin/site.register') }}</button>
                                </div>

                                {{-- <div class="d-table-cell align-middle">
                                <a class="link-to" href="#">Sign in</a>
                            </div> --}}
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
            </div>

            {{-- form farmer --}}
            <div class="panel" id="farmer">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <h2>{{ trans('Admin/site.signfarmer') }}</h2>

                        <!-- start form -->
                        <form class="auth-form" name="form-login" method="POST"
                            action="{{ route('farmer.login.post') }}">
                            @csrf
                            <div class="input-wrp">
                                <input id="login" class="textfield" type="login" name="login"
                                    required autofocus placeholder=" {{ trans('Admin/site.loginby') }}" />
                                @error('login')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" name="password" id="password" required
                                    autocomplete="current-password" placeholder="{{ trans('Admin/site.password') }}" />
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
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
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">{{ trans('Admin/site.login') }}</button>
                                </div>

                                {{-- <div class="d-table-cell align-middle">
                                <a class="link-to" href="#">Sign up</a>
                            </div> --}}
                            </div>
                        </form>
                        <!-- end form -->

                        <div class="spacer py-6 d-md-none"></div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                    <h2>{{ trans('Admin/site.newfarmer') }}</h2>

                    <!-- start form -->
                    <form class="auth-form" action="{{ route('farmer.register.post') }}" method="post">
                        @csrf
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.firstname') }}" name="firstname" />
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.lastname') }}" name="lastname" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="email" placeholder="{{ trans('Admin/site.email') }}" name="email" />
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.phone') }}" name="phone" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password') }}" name="password" />
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password_confirmation') }}"
                                    name="password_confirmation" />
                            </div>

                        <div class="d-table mt-8">
                            <div class="d-table-cell align-middle">
                                <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">{{ trans('Admin/site.register') }}</button>
                            </div>

                            {{-- <div class="d-table-cell align-middle">
                                <a class="link-to" href="#">Sign in</a>
                            </div> --}}
                        </div>
                    </form>
                    <!-- end form -->
                </div>
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
                        <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_3.jpg"
                                alt="demo" /></a>
                    </div>

                    <div class="col-12 col-lg-6">
                        <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_4.jpg"
                                alt="demo" /></a>
                    </div>
                </div>
            </div>
            <!-- end banner simple -->
        </div>
    </section>
    <!-- end section -->

@endsection

@push('js')
    <script>
        $('#sectionselect').change(function() {
            var myid = $(this).val();
            console.log(myid);
            $('.panel').each(function() {
                myid === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        });
    </script>
@endpush

