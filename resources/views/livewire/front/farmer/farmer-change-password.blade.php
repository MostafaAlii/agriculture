@section('title', __('website\home.change_password'))
@section('css')

@endsection
<div>
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

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo"/>
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo"/>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- start checkout -->
                    <div class="checkout">
                        <h2>{{ __('website\home.changefarmer') }}</h2>

                        <div class="spacer py-3"></div>
                        @if (session()->has('password_message'))
                        <div class="alert alert-success" role="alert">
                            <strong style="padding-right: 35px;">{{ session()->get('password_message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session()->has('password_error'))
                        <div class="alert alert-warning" role="alert">
                            <strong style="padding-right: 35px;">{{ session()->get('password_error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <form class="checkout__form" action="#" wire:submit.prevent='changePassword' autocomplete="off">
                            <div class="row justify-content-xl-between">
                                <div class="col-12 col-md-5 col-lg-6">
                                    <div><h6>{{ __('website\home.change_password') }}</h6></div>
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                            <div class="input-wrp">
                                                <label for="" class="col-md-4 control-label">{{ __('website\home.curpassword') }}</label>
                                                <input class="textfield" placeholder="{{ __('website\home.curpassword') }} *"
                                                type="password" name="current_password" wire:model='current_password'/>
                                            </div>
                                            @error('current_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                            <div class="input-wrp">
                                                <label for="" class="col-md-4 control-label">{{ __('website\home.newpassword') }}</label>
                                                <input class="textfield" placeholder="{{ __('website\home.newpassword') }} *"
                                                type="password" name="password"/ wire:model='password'>
                                            </div>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-12 col-lg-12">
                                            <div class="input-wrp">
                                                <label for="" class="col-md-4 control-label">{{ __('website\home.confirmpassword') }}</label>
                                                <input class="textfield" placeholder="{{ __('website\home.confirmpassword') }} *"
                                                type="password" name="password_confirmation" wire:model='confirm_password'/>
                                            </div>
                                            @error('confirm_password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="spacer py-6"></div>
                                    <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                    type="submit"
                                    role="button">{{ __('Admin/site.save') }}</button>
                                    <div class="spacer py-6 d-md-none"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- end checkout -->

                </div>
            </div>
        </div>
    </section>
    <!-- end section -->
</div>

