@extends('front.layouts.master')
@section('title', 'home Page ')
@section('content')
<main role="main">
    <!-- Common styles
    ================================================== -->
    <link rel="stylesheet" href="css/style.min.css" type="text/css">

    <!-- Load lazyLoad scripts
    ================================================== -->
    <script>
        (function(w, d){
            var m = d.getElementsByTagName('main')[0],
                s = d.createElement("script"),
                v = !("IntersectionObserver" in w) ? "8.17.0" : "10.19.0",
                o = {
                    elements_selector: ".lazy",
                    data_src: 'src',
                    data_srcset: 'srcset',
                    threshold: 500,
                    callback_enter: function (element) {

                    },
                    callback_load: function (element) {
                        element.removeAttribute('data-src')

                        oTimeout = setTimeout(function ()
                        {
                            clearTimeout(oTimeout);

                            AOS.refresh();
                        }, 1000);
                    },
                    callback_set: function (element) {

                    },
                    callback_error: function(element) {
                        element.src = "https://placeholdit.imgix.net/~text?txtsize=21&txt=Image%20not%20load&w=200&h=200";
                    }
                };
            s.type = 'text/javascript';
            s.async = true; // This includes the script as async. See the "recipes" section for more information about async loading of LazyLoad.
            s.src = "https://cdn.jsdelivr.net/npm/vanilla-lazyload@" + v + "/dist/lazyload.min.js";
            m.appendChild(s);
            // m.insertBefore(s, m.firstChild);
            w.lazyLoadOptions = o;
        }(window, document));
    </script>

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
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/feature_img/4.png')}}" alt="demo" />
                                </i>

                                <h5 class="__title">Vegatables</h5>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="500" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/feature_img/5.png')}}" alt="demo" />
                                </i>

                                <h5 class="__title">Awesome Wheats</h5>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="600" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/feature_img/6.png')}}" alt="demo" />
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
            <img id="bg-img-1" class="img-fluid lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/agro.png')}}" alt="demo" />
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
                <div class="col-12 col-lg-4">
                    <div data-aos="fade-left" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                        <div class="section-heading">
                            <h2 class="__title">About agro  <span>farm company</span></h2>
                        </div>

                        <p class="d-none d-sm-block">
                            <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">More about</a>
                        </p>
                    </div>
                </div>

                <div class="col-12 my-3 d-lg-none"></div>

                <div class="col-12 col-lg-4  text-center">
                    <div data-aos="fade-up" ddata-aos-duration="600" data-aos-offset="100">
                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/img_1.png')}}" alt="demo" />
                    </div>
                </div>

                <div class="col-12 my-3 d-lg-none"></div>

                <div class="col-12 col-lg-4">
                    <div data-aos="fade-right" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                        <p>
                            Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.
                        </p>

                        <p>
                            The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classi
                        </p>

                        <p class="d-sm-none">
                            <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">More about</a>
                        </p>
                    </div>
                </div>
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
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/ico/ico_count_1.png')}}" alt="demo" />
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
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/ico/ico_count_2.png')}}" alt="demo" />
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
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/ico/ico_count_3.png')}}" alt="demo" />
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
                                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/ico/ico_count_4.png')}}" alt="demo" />
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
                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/img_world_map.png')}}" alt="demo" />
            </div>
        </div>
    </section>
    <!-- end section -->

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
                                            <h2>agro <span>products</span></h2>

                                            <p>
                                                Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                            </p>

                                            <p>
                                                <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#">all products</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-5 col-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/1.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">fruits</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-4 col-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/2.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">Vegatables</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-4 col-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/3.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">livestock</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-4 col-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/4.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">Sunflowers</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-xl-6">
                            <div class="__item">
                                <div class="__content">
                                    <h2 class="__title"><b>12</b>Type of <br>products</h2>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-7 col-xl-6 offset-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/5.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">Wheat</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-md-5 col-xl-3">
                            <div class="__item">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/product-preview_img/6.jpg')}}"  alt="demo" />
                                </figure>

                                <div class="__content">
                                    <h3 class="__title">Spices</h3>
                                </div>

                                <a class="__link" href="#"></a>
                            </div>
                        </div>
                        <!-- end item -->
                    </div>
                </div>
            </div>
            <!-- end product preview -->
        </div>
    </section>
    <!-- end section -->

    <!-- start section -->
    <section class="section section--review  lazy" data-src="{{ asset('frontassets/img/review_bg_1.png')}}">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">People says <span>about agro</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <!-- start review -->
            <div class="review review--slider">
                <div class="js-slick" data-slick='{"autoplay": true, "arrows": false, "dots": true, "speed": 1000}'>
                    <!-- start item -->
                    <div class="review__item">
                        <div class="review__item__text">
                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>
                        </div>

                        <div class="review__item__author  d-table">
                            <div class="d-table-cell align-middle">
                                <div class="review__item__author-image">
                                    <img class="circled" src="{{ asset('frontassets/img/ava.png')}}" alt="ava" />
                                </div>
                            </div>

                            <div class="d-table-cell align-middle">
                                <span class="review__item__author-name"><strong>Terens Smith</strong></span>
                                <span class="review__item__author-position">/CEO AntalAgro</span>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->

                    <!-- start item -->
                    <div class="review__item">
                        <div class="review__item__text">
                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>

                            <p>
                                <i>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.  Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over</i>
                            </p>
                        </div>

                        <div class="review__item__author  d-table">
                            <div class="d-table-cell align-middle">
                                <div class="review__item__author-image">
                                    <img class="circled" src="{{ asset('frontassets/img/ava.png')}}" alt="ava" />
                                </div>
                            </div>

                            <div class="d-table-cell align-middle">
                                <span class="review__item__author-name"><strong>Terens Smith</strong></span>
                                <span class="review__item__author-position">/CEO AntalAgro</span>
                            </div>
                        </div>
                    </div>
                    <!-- end item -->
                </div>
            </div>
            <!-- start review -->
        </div>
    </section>
    <!-- end section -->

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
                            <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/site_logo.png')}}" alt="demo" />

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

    <!-- start section -->
    <section class="section section--no-pb">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">Blog <span>Posts</span></h2>

                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.</p>
            </div>

            <!-- start posts -->
            <div class="posts posts--style-1">
                <div class="__inner">
                    <div class="row">
                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="100" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/posts_img/1.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">ORGANIC FOOD/TIPS & GUIDES</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Tips for Ripening your Fruit</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>

                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="blog_details.html">Read more</a>
                                </div>

                                <span class="__date-post">
                                    <strong>07</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="200" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/posts_img/2.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Health Benefits of a Raw Food</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>

                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="blog_details.html">Read more</a>
                                </div>

                                <span class="__date-post">
                                    <strong>03</strong>Nov
                                </span>
                            </div>
                        </div>
                        <!-- end item -->

                        <!-- start item -->
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="300" data-aos-offset="0">
                                <figure class="__image">
                                    <img class="lazy" src="{{ asset('frontassets/img/blank.gif')}}" data-src="{{ asset('frontassets/img/posts_img/3.jpg')}}" alt="demo" />
                                </figure>

                                <div class="__content">
                                    <p class="__category"><a href="#">DIET/ORGANIC FOOD</a></p>

                                    <h3 class="__title h5"><a href="blog_details.html">Superfoods you should be eating</a></h3>

                                    <p>
                                        The generated Lorem Ipsum is therefore always free from repetition injected humour, or non-characteristic words etc.
                                    </p>

                                    <a class="custom-btn custom-btn--medium custom-btn--style-1" href="blog_details.html">Read more</a>
                                </div>

                                <span class="__date-post">
                                    <strong>25</strong>oct
                                </span>
                            </div>
                        </div>
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
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/1.jpg')}}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/2.jpg')}}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/3.jpg')}}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/4.jpg')}}" alt="demo" />
                    </div>

                    <div class="__item">
                        <img class="img-fluid m-auto" src="{{ asset('frontassets/img/partners_img/5.jpg')}}" alt="demo" />
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
        <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309" data-latitude="34.109925" data-marker="{{ asset('frontassets/img/marker.png')}}" style="min-height: 255px"></div>
    </section>
    <!-- end section -->
</main>
@endsection

