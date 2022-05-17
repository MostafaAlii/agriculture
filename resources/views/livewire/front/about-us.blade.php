@section('title', __('website\home.aboutus'))
@section('css')

@endsection
<br>
<br>
<div>
    @foreach($about_us as $info)
   	<!-- start section -->
       <section class="section section--no-pb section--custom-01" style="background-image: url('<?php echo asset('Dashboard/img/about/'.$info->image);?>');">
        <div class="container">
           
            <div class="section-heading">
                <h2 class="__title">{{$info->title}}</h2>
            </div>

            <div class="row">
                <div class="col-12 col-lg-6 col-xl-8">
                    <p>{!! $info->description !!} </p>

                </div>
            </div>
            
        </div>
        <br>
    </section>
    <!-- end section -->
    @endforeach


@include('livewire.front._counter')


    <!-- start section -->
    <section class="section section--no-pb section--custom-03">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">our dream <span>team</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <!-- start team -->
            <div class="team">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="100" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/1.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">William Doe</h5>

                                    <span>Tractor-Driver</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="200" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/2.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">Jack Silver</h5>

                                    <span>Mechanic</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="300" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/3.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">Billi Moore</h5>

                                    <span>Combine Operator</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="400" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/4.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">Steve Jonson</h5>

                                    <span>Agronomist</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="500" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/5.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">Billi Moorer</h5>

                                    <span>Assistant</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="__item" data-aos="fade" data-aos-delay="600" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/team_img/6.jpg') }}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h5 class="__title">Allan Bolt</h5>

                                    <span>Farmer</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end team -->
        </div>
    </section>
    <!-- end section -->

    

@include('livewire.front._brand')

@include('livewire.front._review_form')

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png') }}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>
