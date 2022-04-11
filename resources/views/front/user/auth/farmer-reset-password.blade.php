{{-- @extends('front.layouts.master') --}}
@extends('front.layouts.master5')
@section('title', __('website\home.resetpass'))
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
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo"/>
        </div>



        <div class="container">
            {{-- form user --}}
            {{-- <div class="panel" id="user"> --}}
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <h2>{{ trans('Admin/site.signvendor') }}</h2>
                        {{-- @include('dashboard.common._partials.messages') --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('status'))
                        <div class="alert alert-success" role="alert">
                            <strong style="padding-right: 35px;">{{ session()->get('status') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <!-- start user login form -->
                        <form class="auth-form" name="form-login" method="POST" action="{{ route('farmer.password.update') }}">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="input-wrp">
                                    <label for="" class="col-md-4 control-label">{{ __('website\home.email') }}</label>
                                    <input id="login" class="textfield" type="login" name="email" :value="old('email')"
                                        required autofocus placeholder=" {{ trans('Admin/site.email') }}" />
                                </div>
                                @error('email')
                                     <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>


                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="input-wrp">
                                    <label for="" class="col-md-4 control-label">{{ __('website\home.newpassword') }}</label>
                                    <input class="textfield" placeholder="{{ __('website\home.newpassword') }} *"
                                    type="password" name="password" required />
                                </div>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                <div class="input-wrp">
                                    <label for="" class="col-md-4 control-label">{{ __('website\home.confirmpassword') }}</label>
                                    <input class="textfield" placeholder="{{ __('website\home.confirmpassword') }} *"
                                    type="password"
                                    name="password_confirmation" required/>
                                </div>
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-table mt-8">
                                <div class="d-table-cell align-middle">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button"> {{ __('website\home.ResetPassword') }}</button>
                                </div>

                                {{-- <div class="d-table-cell align-middle">
                                <a class="link-to" href="#">Sign up</a>
                            </div> --}}
                            </div>
                        </form>
                        <!-- end user login form -->

                        <div class="spacer py-6 d-md-none"></div>

                    </div>


                </div>
            {{-- </div> --}}


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
        var type = $('#sectionselect').data('val');
        $('.panel').each(function() {
                type === $(this).attr('id') ? $(this).show() : $(this).hide();
            });
        // console.log(type);
        // $('.panel').show();
        // var myid = $(this).val();
        //     console.log(myid);
        //     $('.panel').each(function() {
        //         myid === $(this).val ? $(this).show() : $(this).hide();
        //     });

    //     $(function() {
    //    $("select").each(function (index, element) {
    //             const val = $(this).data('value');
    //             if(val !== '') {
    //                 $(this).val(val);
    //             }
    //            });
    //     });

    </script>
@endpush

