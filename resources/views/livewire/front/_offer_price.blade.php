@if(isset($offer_product))
    <!-- start section -->
    <section class="section section--no-pt section--no-pb section--gutter">
        <!-- start banner simple -->
        <div class="simple-banner simple-banner--style-1" data-aos="fade" data-aos-offset="50" style="background-image:url('{{ asset('Dashboard/img/products/' . $offer_product->image->filename) }}')">;
            <div class="__label d-none d-md-block">
                <div class="d-table m-auto h-100">
                    <div class="d-table-cell align-middle">
                        <span class="num-1">{{$offer_product->special_price}}</span>
                    </div>

                    <div class="d-table-cell align-middle">
                        <span class="num-2">$</span>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="__inner">
                            <!-- Start -->
                            @if(app()->getLocale()=='ar')
                                <img class="img-logo  img-fluid  lazy"
                                    src="{{ setting()->ar_site_logo ?
                                    URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo) :
                                    URL::asset('Dashboard/img/Default/logo_ar.png')}}"  alt=""
                                    style="left: 45%;   width: 145px;height: 200px;  "/>
                            @elseif(app()->getLocale()=='ku')
                                <img class="img-logo  img-fluid  lazy"
                                    src="{{setting()->ku_site_logo ?
                                    URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo) :
                                    URL::asset('Dashboard/img/Default/logo_ku.png')}}"
                                    alt="" style="left: 45%;    width: 145px;height: 200px;"/>
                            @elseif(app()->getLocale()=='en')
                                <img class="img-logo  img-fluid  lazy" src="{{setting()->en_site_logo ?
                                    URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo) :
                                    URL::asset('Dashboard/img/Default/logo_en.png')}}"
                                    alt="" style="left: 45%;    width: 145px;height: 200px;"/>
                            @endif
                            <!-- End -->

                            <div class="row">
                                <div class="col-12 col-lg-7 col-xl-6">
                                    <div class="banner__text" data-aos="fade-left" data-delay="500">
                                        <h2 class="__title h1">
                                            <b style="display: block; color: #c6c820;">
                                                <a href="{{ route('product_details', encrypt($offer_product->id)) }}">{{$offer_product->name}}</a>
                                            </b>
                                        </h2>
                                        <p style="margin-right: -35px !important;">
                                        {{substr($offer_product->description,0,100)}}...
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
@endif