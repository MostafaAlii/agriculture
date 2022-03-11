<div>
@section('title', __('website\home.contactus'))
@section('css')

@endsection
   <!-- start section -->
   <section class="section">
    <div class="container">
        <!-- start company contacts -->
        <div class="company-contacts  text-center">
            <div class="__inner">
                <div class="row justify-content-around">
                    <!-- start item -->
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="__item">
                            <i class="__ico fontello-location"></i>

                            <h4 class="__title">adress</h4>

                            <p>
                                523 Sylvan Ave, 5th Floor Mountain View, CA 94041USA
                            </p>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="__item">
                            <i class="__ico fontello-phone"></i>

                            <h4 class="__title">phone</h4>

                            <p>
                                +1 (234) 56789,<br>+1 987 654 3210
                            </p>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="__item">
                            <i class="__ico fontello-mail-1"></i>

                            <h4 class="__title">e-mail</h4>

                            <p><a href="mailto:support@agrocompany.com">support@agrocompany.com</a></p>
                        </div>
                    </div>
                    <!-- end item -->
                </div>
            </div>
        </div>
        <!-- end company contacts -->
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="section section--dark-bg  section--contacts">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-12 col-md-6">

                <div class="row justify-content-end">
                    <div class="col-md-11">
                        <div class="section-heading section-heading--white">
                            <h2 class="__title">{{ __('website\home.get') }} <span>{{ __('website\home.touch') }} </span></h2>

                            <p>{{ __('website\home.contactsms') }}</p>
                        </div>
                        @if (session()->has('message'))
                        <div class="alert alert-success " role="alert">
                            <strong style="padding-right: 35px;">{{ session()->get('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                        <form class="contact-form js-contact-form" wire:submit.prevent='sendMessage' autocomplete="off">
                            <div class="input-wrp">
                                <input class="textfield" name="firstname" type="text" placeholder="{{ __('website\home.firstname') }}" wire:model='firstname'/>
                                @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" name="lastname" type="text" placeholder="{{ __('website\home.lastname') }}" wire:model='lastname'/>
                                @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-wrp">
                                <input class="textfield" name="phone" type="number" placeholder="{{ __('website\home.phone') }}" wire:model='phone'/>
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <input class="textfield" name="email" type="email" placeholder="{{ __('website\home.email') }}" wire:model='email'/>
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-wrp">
                                <textarea class="textfield" name="message" placeholder="{{ __('website\home.comment') }}" wire:model='comment'></textarea>
                                @error('comment')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">{{ __('website\home.send') }}</button>

                            <div class="form__note"></div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row no-gutters">
        <div class="col-md-6  map-container map-container--left">
            <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d407663.45171337907!2d43.516394316650484!3d37.036728793837455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40089f340fb54ddd%3A0xa62d864aff7c9d78!2z2K_Zh9mI2YMg2YXYrdin2YHYuNip2Iwg2KfZhNi52LHYp9mC!5e0!3m2!1sar!2seg!4v1646889287564!5m2!1sar!2seg" width="900" height="920" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            {{-- <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png" style="min-height: 255px"></div> --}}
        </div>
    </div>
</section>
<!-- end section -->

@push('js')

@endpush
</div>
