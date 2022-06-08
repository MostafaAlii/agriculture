{{-- @extends('front.layouts.master') --}}
@extends('front.layouts.master5')
@section('title', __('website\home.login'))
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
            {{-- form farmer --}}
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                        <h2>{{ trans('Admin/site.signfarmer') }}</h2>

                        <!-- start form -->
                        <form class="auth-form" name="form-login" method="POST"
                            action="{{ route('farmer.login.post') }}" autocomplete="off">
                            @csrf
                            <div class="input-wrp">
                                <input id="login" class="textfield" type="login" name="login" value="{{ old('login') }}"
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
                                        {{ __('Website/home.rememberme') }}
                                    </label>
                                </div>

                                <div class="col-auto">
                                    <a class="link-forgot" href="{{ route('farmer.password.request') }}">{{ __('Website/home.lostpassword') }}</a>
                                </div>
                            </div>

                            <div class="d-table mt-8">
                                <div class="d-table-cell align-middle">
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit"
                                        role="button">{{ trans('Admin/site.login') }}</button>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->

                        <div class="spacer py-6 d-md-none"></div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2">
                    <h2>{{ trans('Admin/site.newfarmer') }}</h2>

                    <!-- start form -->
                    <form class="auth-form" action="{{ route('farmer.register.post') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="type" value="farmer">
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.firstname') }}" name="firstname" value="{{ old('firstname') }}" required />
                                @error('firstname')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.lastname') }}" name="lastname" value="{{ old('lastname') }}" required />
                                @error('lastname')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="email" placeholder="{{ trans('Admin/site.email') }}" name="email" value="{{ old('email') }}" required/>
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" type="text" placeholder="{{ trans('Admin/site.phone') }}" name="phone" value="{{ old('phone') }}"
                                maxlength="11" minlength="11"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required />
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password') }}" name="password" value="{{ old('password') }}" required />
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" type="password" placeholder="{{ trans('Admin/site.password_confirmation') }}"
                                    name="password_confirmation" />
                                    @error('password_confirmation')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                            </div>
                            <div class="input-wrp">
                                <div class="{{$errors->has('g-recaptcha-response')? 'has-error' : ''}}">
                                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                                </div>
                                @error('g-recaptcha-response')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
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
    </section>


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

