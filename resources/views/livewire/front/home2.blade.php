@section('title', __('website\home.home'))
@section('css')
<style>
      .review--slider {
    @if (app()->getLocale() == 'en')
    direction: ltr;
    /* @else
    direction: ltr; */
    @endif
    }

</style>
<style>
       .start-screen[data-scroll-discover=true] .scroll-discover {
        display: none;
    }
</style>

@endsection
<div>
    <section class="section">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">{{__('Admin\site.administrative_part')}}</h2>

                <p>{{__('Admin\site.administrative_desc')}}</p>
            </div>
            <div class="feature feature--style-1">
                <div class="__inner">
                    <div class="row">
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="100" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/2.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\site.animal_wealth')}}

                                </h5>
                                <h6>{{ \App\Models\CawProject::where('marketing_side','like','govermental')->count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="200" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/1.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\site.Horticulture')}}</h5>
                                <h6>{{ \App\Models\Orchard::count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="300" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/3.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\site.planet_protection')}}</h5>
                                <h6>{{ \App\Models\BeeKeeper::count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="400" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/4.png') }}" alt="demo" />
                                </i>
                                <h5 class="__title">{{__('Admin\site.planning')}}</h5>
                                <h6>{{ \App\Models\LandArea::count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="600" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/5.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\site.services')}}</h5>
                                <h6>{{ \App\Models\FarmerService::count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4 col-lg-2">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="600" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                        data-src="{{ asset('frontassets/img/feature_img/10.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\site.farmer')}}</h5>
                                <h6>{{ \App\Models\Farmer::count() }} %</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end feature -->
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title">{{__('Admin\site.wholesale')}}</h2>

                <p>{{__('Admin\site.wholesale_desc')}}</p>
            </div>
            <div class="feature feature--style-1">
                <div class="__inner">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="100" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/feature_img/6.png') }}" alt="demo" />
                                </i>
                                <h5 class="__title">{{__('Admin\outcome_products.outcome_productPageTitle')}}
                                </h5>
                                <h6>{{ \App\Models\OutcomeProduct::count() }} %</h6>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-6">
                            <div class="__item  text-center" data-aos="fade" data-aos-delay="200" data-aos-offset="100">
                                <i class="__ico">
                                    <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                                            data-src="{{ asset('frontassets/img/feature_img/12.png') }}" alt="demo" />
                                </i>

                                <h5 class="__title">{{__('Admin\income_products.income_productPageTitle')}}</h5>
                                <h6>{{ \App\Models\IncomeProduct::count() }} %</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end feature -->
        </div>
    </section>
    <section class="section section--no-pt section--no-pb">
        <div class="container">
            <div class="special-offer special-offer--style-1" data-aos="zoom-in" data-aos-duration="600"
                data-aos-offset="70">

                <h2 class="text text-center lazy " style="font-size: 8rem;"
                    data-src="{{ asset('frontassets/img/special_offer_text_bg.jpg') }}">{{ __('Website/home.homesms') }}</h2>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="d-none d-lg-block">
            <img id="bg-img-1" class="img-fluid lazy" src="{{ asset('frontassets/img/blank.gif') }}"
            data-src="{{ asset('frontassets/img/agro.png') }}" alt="demo" />
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

        {{-- <div class="container">
            <div class="row align-items-center">
                <?php $x=0;?>
                @foreach($about_us as $info)
                <div class="col-12 col-lg-4">
                    <div data-aos="fade-left" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                        <div class="section-heading">
                            <h2 class="__title">{{ $info->title }}</h2>
                        </div>

                        <p class="d-none d-sm-block">
                            <a class="custom-btn custom-btn--medium custom-btn--style-1" href="{{route('aboutUs')}}">{{__('Website/home.about_more')}}</a>
                        </p>
                    </div>
                </div>
                <?php if($x==0){?>
                    <div class="col-12 my-3 d-lg-none"></div>

                    <div class="col-12 col-lg-4  text-center">
                        <div data-aos="fade-up" ddata-aos-duration="600" data-aos-offset="100">
                            <img class="img-fluid  lazy" src="{{ asset('Dashboard/img/about/'.$info->image) }}" data-src="{{ asset('Dashboard/img/about/'.$info->image) }}" style="width:500px;height:400px" alt="demo" />
                        </div>
                    </div>
                <?php }?>
                <div class="col-12 my-3 d-lg-none"></div>

                <div class="col-12 col-lg-4">
                    <div data-aos="fade-right" data-aos-delay="400" data-aos-duration="500" ddata-aos-offset="100">
                            <p><?php echo substr($info->description,0,500);?>...</p>
                    </div>
                </div>
                <?php $x++;?>
                @endforeach
            </div>
        </div> --}}
    </section>
    @include('livewire.front._counter')
    <section class="section">
        <div class="container">
            <div class="section-heading section-heading--center" data-aos="fade">
                <h2 class="__title"> {{ __('Admin/site.we') }} <span> {{ __('Admin/site.world') }}</span></h2>

                <p>{{ __('Admin/site.worldsms') }}</p>
            </div>

            <div data-aos="slide-up" data-aos-duration="800" data-aos-offset="50">
                <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}"
                    data-src="{{ asset('frontassets/img/img_world_map.png') }}" alt="demo" />
            </div>
        </div>
    </section>
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


@include('livewire.front._home_review')

@include('livewire.front._offer_price')

<!-- start section blog-->
<section class="section section--no-pb">
    <div class="container">
        <div class="section-heading section-heading--center" data-aos="fade">
            <h2 class="__title">{{ __('website\home.blog') }}</h2>
        </div>
        <!-- start posts -->
        <div class="posts posts--style-1">
            <div class="__inner">
                <div class="row">
                    <!-- end item -->
                    @forelse (Blog::orderByDesc('created_at')->limit(3)->get() as $blog)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="__item __item--preview" data-aos="flip-up" data-aos-delay="100" data-aos-offset="0">
                                <figure class="__image">
                                    @if ($blog->image_path)
                                    <img src="{{ $blog->image_path }}"
                                        data-src="{{ $blog->image_path }}" alt="{{ $blog->title }}" />
                                    @else
                                    <img src="{{ asset('Dashboard/img/Default/default_blog.jpg') }}"
                                        data-src="{{ asset('Dashboard/img/Default/default_blog.jpg') }}" alt="demo" />
                                    @endif
                                </figure>
                                <div class="__content">
                                    <p class="__category">
                                        <a href="{{ route('blogdetails', encrypt($blog->id)) }}">
                                            {{ $blog->admin->firstname}}
                                        </a>
                                    </p>
                        
                                    <h3 class="__title h5"><a href="{{ route('blogdetails', encrypt($blog->id)) }}">{{ $blog->title }}</a>
                                    </h3>
                        
                                    <p>
                                        {{ Str::limit($blog->body, 50) }}
                                    </p>
                        
                                    <a class="custom-btn custom-btn--medium custom-btn--style-1"
                                        href="{{ route('blogdetails', encrypt($blog->id)) }}">{{ __('website\home.readmore') }}</a>
                                </div>
                        
                                <span class="__date-post">
                                    <strong>{{ $blog->created_at->diffforhumans() }}</strong>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div>
                            <h3 class="text-danger">{{ trans('Admin\general.blogs_not_found') }}</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- end posts -->
    </div>
</section>
<!-- end section -->

@include('livewire.front._brand')

@include('livewire.front._review_form')

<!-- start section -->
<section class="section section--no-pt section--no-pb">
    <!-- this is demo key "AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" -->
    <div class="g_map" data-api-key="AIzaSyBXQROV5YMCERGIIuwxrmaZbBl_Wm4Dy5U" data-longitude="44.958309"
        data-latitude="34.109925" data-marker="{{ asset('frontassets/img/marker.png') }}" style="min-height: 255px">
    </div>
</section>
<!-- end section -->
</div>
