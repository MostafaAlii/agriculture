@if(isset($offer_product))
    <!-- start section -->
    <section class="section section--no-pt section--no-pb section--gutter">
        <!-- start banner simple -->
        <div class="simple-banner simple-banner--style-1" data-aos="fade" data-aos-offset="50">

            <div class="__label d-none d-md-block" >
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
                            @if(app()->getLocale()=='ar')
                                <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}"
                                     data-src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}" width="70" height="70"
                                     alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                            @else
                                <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}"
                                     data-src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}" width="70" height="70"
                                     alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                            @endif

                            <div class="row">
                                <div class="col-12 col-lg-7 col-xl-6">
                                    <div class="banner__text" data-aos="fade-left" data-delay="500">
                                        <h2 class="__title h1">
                                            <b style="display: block; color: #c6c820;">
                                                {{$offer_product->name}}
                                            </b>
                                        </h2>

                                        <p>
                                        {{substr($offer_product->name,0,100)}}...
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