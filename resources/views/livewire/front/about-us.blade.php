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
    </section>
    <!-- end section -->
    @endforeach

    <!-- start section -->
    <section class="section">
        <div class="container">
            <!-- start counters -->
            <div class="counter">
                <div class="__inner">
                    <div class="row justify-content-sm-center">
                        <!-- start item -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                            <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="150">
                                <div class="d-table">
                                    <div class="d-table-cell align-middle">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_1-1.png') }}" alt="demo" />
                                        </i>
                                    </div>

                                    <div class="d-table-cell align-middle">
                                        <p class="__count js-count" data-from="0" data-to="19500">19 500</p>

                                        <p class="__title">Tons of harvest</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                            <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="300">
                                <div class="d-table">
                                    <div class="d-table-cell align-middle">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_2-1.png') }}" alt="demo" />
                                        </i>
                                    </div>

                                    <div class="d-table-cell align-middle">
                                        <p class="__count js-count" data-from="0" data-to="2720">2 720</p>

                                        <p class="__title">Units of Cattle</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                            <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="450">
                                <div class="d-table">
                                    <div class="d-table-cell align-middle">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_3-1.png') }}" alt="demo" />
                                        </i>
                                    </div>

                                    <div class="d-table-cell align-middle">
                                        <p class="__count js-count" data-from="0" data-to="10000">10 000</p>

                                        <p class="__title">Hectares of farm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-3">
                            <div class="__item" data-aos="zoom-in" data-aos-duration="350" data-aos-delay="600">
                                <div class="d-table">
                                    <div class="d-table-cell align-middle">
                                        <i class="__ico">
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_4-1.png') }}" alt="demo" />
                                        </i>
                                    </div>

                                    <div class="d-table-cell align-middle">
                                        <p class="__count js-count" data-from="0" data-to="128">128</p>

                                        <p class="__title">Units of technic</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end counters -->
        </div>
    </section>
    <!-- end section -->
    
    <!-- start section -->
    <section class="section">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">Partners</h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <div class="partners-list">
                <div class="js-slick"
                     data-slick='{
                     "autoplay": true,
                     "arrows": false,
                     "dots": true,
                     "speed": 1000,
                     "responsive": [
                        {
                            "breakpoint":576,
                            "settings":{
                                "slidesToShow": 2
                            }
                        },
                        {
                            "breakpoint":767,
                            "settings":{
                                "slidesToShow": 3
                            }
                        },
                        {
                            "breakpoint":991,
                            "settings":{
                                "slidesToShow": 4
                            }
                        },
                        {
                            "breakpoint":1199,
                            "settings":{
                                "autoplay": false,
                                "dots": false,
                                "slidesToShow": 5
                            }
                        }
                    ]}'>
                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/1.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/2.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/3.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/4.jpg') }}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/5.jpg') }}" alt="demo" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section -->

    @if(Session::has('success'))
        <div>
           <center><h3 style="color:#bfa43c">{{Session::get('success')}}</h2></center>
           <br>
        </div>
    @endif
    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">{{__('Admin/about.review_tit1')}} <span>{{__('Admin/about.review_tit2')}}</span></h2>

                <p>{{__('Admin/about.msg')}} </p>
            </div>

            <form class="contact-form" action="{{route('review.add')}}" data-aos="fade">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" value="{{old('name')}}" type="text" placeholder="{{__('Admin/about.name')}}" required/>
                            @error('name')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" value="{{old('email')}}" type="text" placeholder="{{__('Admin/about.email')}}" required/>
                            @error('email')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="{{__('Admin/about.message')}}" required>{{old('message')}}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">{{__('Admin/about.send')}}</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--no-pt section--no-pb">
        <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="img/marker.png') }}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</div>
