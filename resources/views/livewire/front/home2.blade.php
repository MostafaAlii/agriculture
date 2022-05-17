@section('title', __('website\home.home'))
@section('css')

@endsection
<div>
{{-- ********************** Home 1 ****************************************** --}}
        <!-- start section -->
        <section class="section">
            <div class="container">
                <div class="section-heading section-heading--center" data-aos="fade">
                    <h2 class="__title">Special <span>Offers</span></h2>

                    <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                </div>

                <!-- start feature -->
                <div class="feature feature--style-1">
                    <div class="__inner">
                        <div class="row">
                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="100" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/1.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Farm Livestock</h5>
                                </div>
                            </div>
                            <!-- end item -->

                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="200" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/2.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Garden Tillage</h5>
                                </div>
                            </div>
                            <!-- end item -->

                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="300" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/3.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Fresh Fruits</h5>
                                </div>
                            </div>
                            <!-- end item -->

                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="400" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/4.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Vegatables</h5>
                                </div>
                            </div>
                            <!-- end item -->

                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="500" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/5.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Awesome Wheats</h5>
                                </div>
                            </div>
                            <!-- end item -->

                            <!-- start item -->
                            <div class="col-6 col-sm-4 col-lg-2">
                                <div class="__item  text-center" data-aos="fade" data-aos-delay="600" data-aos-offset="100">
                                    <i class="__ico">
                                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/feature_img/6.png') }}" alt="demo" />
                                    </i>

                                    <h5 class="__title">Agro Machinery</h5>
                                </div>
                            </div>
                            <!-- end item -->
                        </div>
                    </div>
                </div>
                <!-- end feature -->
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section section--no-pt section--no-pb">
            <div class="container">
                <div class="special-offer special-offer--style-1" data-aos="zoom-in" data-aos-duration="600" data-aos-offset="70">
                    <h2 class="text text-center lazy"  data-src="{{ asset('frontassets/img/special_offer_text_bg.jpg') }}">Special products for most people</h2>
                </div>
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section">
            <div class="d-none d-lg-block">
                <img id="bg-img-1" class="img-fluid lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/agro.png') }}" alt="demo" />
                <style type="text/css">
                    #bg-img-1
                    {
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        -webkit-transform: translate(-50%,-50%);
                        -ms-transform: translate(-50%,-50%);
                        transform: translate(-50%,-50%);
                    }
                </style>
            </div>

            <div class="container">
                <div class="row align-items-center">
                    @foreach($about_us as $info)
                    <div class="col-12 col-lg-4">
                        <div data-aos="fade-left" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                            <div class="section-heading">
                                <h2 class="__title">{{$info->title}}</h2>
                            </div>

                            <p class="d-none d-sm-block">
                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="{{route('aboutUs')}}">{{__('Website/home.about_more')}}</a>
                            </p>
                        </div>
                    </div>

                    <div class="col-12 my-3 d-lg-none"></div>

                    <div class="col-12 col-lg-4  text-center">
                        <div data-aos="fade-up" ddata-aos-duration="600" data-aos-offset="100">
                            <img class="img-fluid  lazy" src="{{ asset('Dashboard/img/about/'.$info->image) }}" data-src="{{ asset('Dashboard/img/about/'.$info->image) }}" style="width:500px;height:400px" alt="demo" />
                        </div>
                    </div>

                    <div class="col-12 my-3 d-lg-none"></div>

                    <div class="col-12 col-lg-4">
                        <div data-aos="fade-right" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                            <p><?php echo substr($info->description,0,500);?>...</p>


                            <p class="d-sm-none">
                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">More about</a>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section section--gutter section--base-bg">
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
                                                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_1.png') }}" alt="demo" />
                                            </i>
                                        </div>

                                        <div class="d-table-cell align-middle">
                                            <p class="__count js-count" data-from="0" data-to="19500">19 500</p>

                                            <p class="__title">Tons of harvesta</p>
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
                                                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_2.png') }}" alt="demo" />
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
                                                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_3.png') }}" alt="demo" />
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
                                                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/ico/ico_count_4.png') }}" alt="demo" />
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
                    <h2 class="__title">We are <span>on the world</span></h2>

                    <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                </div>

                <div data-aos="slide-up" data-aos-duration="800" data-aos-offset="50">
                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/img_world_map.png') }}" alt="demo" />
                </div>
            </div>
        </section>
        <!-- end section -->

        @if(count($home_category)>0)
        <!-- start section -->
        <section class="section section--no-pt section--no-pb section--gutter">
            <div class="container-fluid px-md-0">
                <!-- start product preview -->
                <div class="product-preview product-preview--style-1">
                    <div class="__inner">
                        <div class="row">
                            <!-- start item -->
                            <div class="col-12 col-md-7 col-xl-6">
                                <div class="__item">
                                    <div class="__intro-text">
                                        <div class="row">
                                            <div class="col-md-11">
                                                @if(app()->getLocale()=='en')
                                                <h2>agro <span>products</span></h2>
                                                @else
                                                <h2><span>منتجاتـ</span> ـنا  </h2>
                                                @endif
                                                <p>
                                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="{{ route('shop') }}">{{ __('website\home.all_products') }}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end item -->

                        <?php
                        $x=1;
                        ?>
                        @foreach($home_category as $cat)
                            <?php
                            if($x>7)continue;
                            ?>
                            <!-- start item -->
                            @if($x==1)
                            <div class="col-12 col-md-5 col-xl-3">
                            @elseif($x==5)
                            <div class="col-12 col-xl-6">
                            @elseif($x==6)
                            <div class="col-12 col-md-7 col-xl-6 offset-xl-3">
                            @else
                            <div class="col-12 col-md-4 col-xl-3">
                            @endif
                                <div class="__item">
                                    @if($x!=5)
                                        <figure class="__image">
                                        @if(!($cat->products)->isEmpty())
                                            @foreach($cat->products->random(1) as $pp)
                                                 <img class="lazy" src="{{ asset('Dashboard/img/products/' .  $pp->image->filename) }}"
                                                data-src="{{ asset('Dashboard/img/products/' . $pp->image->filename) }}"
                                                alt="demo" />
                                            @endforeach
                                        @else
                                            <img class="lazy" src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                alt="demo" />
                                        @endif
                                        </figure>
                                    @endif
                                    <div class="__content">
                                        <h3 class="__title"> @if($x==5) <center><b>{{$category_count}}</b></center>{{ __('website\home.cat_count') }} @else{{$cat->name}}@endif</h3>
                                    </div>

                                    @if($x!=5)<a class="__link" href="{{route('pro_cat',encrypt($cat->id))}}"></a>@endif
                                </div>
                            </div>
                            <!-- end item -->
                            <?php $x++; ?>
                        @endforeach

                        </div>
                    </div>
                </div>
                <!-- end product preview -->
            </div>
        </section>
        <!-- end section -->
        @endif

        @if(count($reviews)>0)
        <!-- start section -->
        <section class="section section--review  lazy" data-src="{{ asset('frontassets/img/review_bg_1.png') }}">
            <div class="container">
                <div class="section-heading section-heading--center" data-aos="fade">
                    <h2 class="__title">{{__('Admin/about.review_title')}}</h2>
                </div>

                <!-- start review -->
                <div class="review review--slider">
                    <div class="js-slick" data-slick='{"autoplay": true, "arrows": false, "dots": true, "speed": 1000}'>
                    @foreach($reviews as $rev)
                    <!-- start item -->
                        <div class="review__item">
                            <div class="review__item__text">
                                <p>
                                    <i>{{$rev->message}}</i>
                                </p>
                            </div>

                            <div class="review__item__author  d-table">
                                <div class="d-table-cell align-middle">
                                    <span class="review__item__author-name"><strong>{{$rev->name}}</strong></span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                        @endforeach

                    </div>
                </div>
                <!-- start review -->
            </div>
        </section>
        <!-- end section -->
        @endif

        <!-- start section -->
        <section class="section section--no-pt section--no-pb section--gutter">
            <!-- start banner simple -->
            <div class="simple-banner simple-banner--style-1" data-aos="fade" data-aos-offset="50">

                <div class="__label d-none d-md-block">
                    <div class="d-table m-auto h-100">
                        <div class="d-table-cell align-middle">
                            <span class="num-1">1</span>
                        </div>

                        <div class="d-table-cell align-middle">
                            <span class="num-2">50$</span>
                            <span>Kg</span>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="__inner">
                                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />

                                <div class="row">
                                    <div class="col-12 col-lg-7 col-xl-5">
                                        <div class="banner__text" data-aos="fade-left" data-delay="500">
                                            <h2 class="__title h1"><b style="display: block; color: #c6c820;">Fresh Apples</b> <span>in Our Store</span></h2>

                                            <p>
                                                The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                            </p>

                                            <p>
                                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">Buy</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end banner simple -->
        </section>
        <!-- end section -->

        <!-- start section blog-->
        <section class="section section--no-pb">
            <div class="container">
                <div class="section-heading section-heading--center" data-aos="fade">
                    <h2 class="__title">{{ __('website\home.blog')}}</h2>
                </div>
                <!-- start posts -->
                <div class="posts posts--style-1">
                    <div class="__inner">
                        <div class="row">
                            <!-- start item -->
                            @foreach (\App\Models\Blog::orderByDesc('created_at')->limit(3)->get() as $blog)
                            <div class="col-12 col-sm-6 col-lg-4">
                                <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="100" data-aos-offset="0">
                                    <figure class="__image">
                                        @if(isset($blog->image->filename))
                                            <img  src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                            data-src="{{ asset('Dashboard/img/blogs/'.$blog->image->filename) }}"
                                            alt="demo" />
                                        @else
                                           <img  src="{{ asset('frontassets/img/blank.gif') }}"
                                           data-src="{{ asset('frontassets/img/posts_img/1.jpg') }}" alt="demo" />
                                        @endif
                                    </figure>
                                    <div class="__content">
                                        <p class="__category"><a href="{{ route('blogdetails',encrypt($blog->id)) }}">{{ $blog->admin->firstname }}</a></p>

                                        <h3 class="__title h5"><a href="{{ route('blogdetails',encrypt($blog->id)) }}">{{ $blog->title }}</a></h3>

                                        <p>
                                            {{ Str::limit($blog->body,50,) }}
                                        </p>

                                        <a class="custom-btn custom-btn--medium custom-btn--style-1" href="{{ route('blogdetails',encrypt($blog->id)) }}">{{ __('website\home.readmore')}}</a>
                                    </div>

                                    <span class="__date-post">
                                        <strong>{{ $blog->created_at->diffforhumans() }}</strong>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                            <!-- end item -->
                        </div>
                    </div>
                </div>
                <!-- end posts -->
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section">
            <div class="container">
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

        <!-- start section -->
        <section class="section section--dark-bg">
            <div class="container">
                <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                    <h2 class="__title">Get <span>in touch</span></h2>

                    <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
                </div>

                <form class="contact-form js-contact-form" action="#" data-aos="fade">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield" name="name" type="text" placeholder="Name" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-wrp">
                                <input class="textfield" name="email" type="text" placeholder="E-mail" />
                            </div>
                        </div>
                    </div>

                    <div class="input-wrp">
                        <textarea class="textfield" name="message" placeholder="Comments"></textarea>
                    </div>

                    <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" type="submit" role="button">Send</button>

                    <div class="form__note"></div>
                </form>
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section section--no-pt section--no-pb">
            <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
            <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="{{ asset('frontassets/img/marker.png') }}" style="min-height: 255px"></div>
        </section>
        <!-- end section -->
</div>
