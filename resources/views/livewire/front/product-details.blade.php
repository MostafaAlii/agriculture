@section('title', __('website\home.productdetails'))
@section('css')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
@if(app()->getLocale()=='ar')
<style>
    .product-wish{
        position: absolute;
        bottom :3%;
        z-index:99;
        left:30px;
        text-align: right;
        padding-top:0;
    }
    .product-wish .fa {
        /* color:red; */
        font-size: 30px;
    }
    .product-wish .fa:hover {
        color:#ff7007;
        font-size: 30px;
    }
    .fill-heart{
        color: #ff7007 !important;
    }
</style>
@else

<style>
    .product-wish{
        position: absolute;
        top:3%;
        left: 0;
        z-index:99;
        right:30px;
        text-align: right;
        padding-top:0;
    }
    .product-wish .fa {
        /* color:red; */
        font-size: 30px;
    }
    .product-wish .fa:hover {
        color:#ff7007;
        font-size: 30px;
    }
    .fill-heart{
        color: #ff7007 !important;
    }

/* -------------------------------------------------- */
div.stars {
  width: 270px;
  display: inline-block;
}
input.star { display: none; }
label.star {
  float: right;
  padding: 10px;
  font-size: 20px;
  color: #444;
  transition: all .2s;
}
input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}
input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}
input.star-1:checked ~ label.star:before { color: #F62; }
label.star:hover { transform: rotate(-15deg) scale(1.3); }
label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}

/* --------------------------------- */
.score {
  display: inline-block;
  font-family: Wingdings;
  font-size: 30px;
  color: #ccc;
  position: relative;
}
.score::before,
.score span::before{
  content: "\2605\2605\2605\2605\2605";
  display: block;
}
.score span {
  color: gold;
  position: absolute;
  top: 0;
  overflow: hidden;
}
</style>
@endif

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
            @php
            $witems = Cart::instance('wishlist')->content()->pluck('id');
            @endphp
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-8 col-lg-9" id="search_data">

                        <!-- start product single -->
                        <div class="product-single">
                            <div class="row">
                                <div class="col-12 col-lg-7">
                                    <div class="__product-img">

                                        @if($product->image->filename)
                                        <img width="330" src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                        @else
                                        <img width="330" src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                        @endif
                                        @if($product->special_price >0)
                                        <span class="product-label product-label--sale">{{ __('Admin/site.sale') }}</span>
                                        @else
                                        <span class="product-label product-label--new">{{ __('Admin/site.new') }}</span>
                                        @endif
                                    </div>
                                    <br>
                                     <!-- --------------------------------------------------- -->
                                    @if (Auth::guard('vendor')->user() )
                                        <h4>{{ __('Website/comments.rate_now') }}</h4>
                                        <form action="">
                                            <input class="star star-5" id="star-5" type="radio" name="star" onclick="javascript:add_rate(5,'product');"/>
                                            <label class="star star-5" for="star-5"></label>
                                            <input class="star star-4" id="star-4" type="radio" name="star" onclick="javascript:add_rate(4,'product');"/>
                                            <label class="star star-4" for="star-4"></label>
                                            <input class="star star-3" id="star-3" type="radio" name="star" onclick="javascript:add_rate(3,'product');"/>
                                            <label class="star star-3" for="star-3"></label>
                                            <input class="star star-2" id="star-2" type="radio" name="star" onclick="javascript:add_rate(2,'product');"/>
                                            <label class="star star-2" for="star-2"></label>
                                            <input class="star star-1" id="star-1" type="radio" name="star" onclick="javascript:add_rate(1,'product');"/>
                                            <label class="star star-1" for="star-1"></label>
                                        </form>
                                    @endif
                                        <!-- --------------------------------------------------- -->

                                </div>

                                <div class="col-12 col-lg-5">
                                    <div class="content-container">
                                        <h3 class="__name">{{ $product->name }}</h3>

                                        @if($product->special_price >0)
                                            <div class="product-price">
                                                <span class="product-price__item product-price__item--old">{{ number_format($product->price, 2) }} $</span>
                                                <span class="product-price__item product-price__item--new">{{ number_format($product->special_price, 2) }} $</span>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                            </div>
                                        @endif


                                        <input type="hidden" id="product_id" value="{{$product->id}}">
                                         <span class="score" id="rate_msg"><span style="width: <?php echo $avg;?>%"></span></span>

                                        <!-- <div class="stars"> -->
                                                
                                        <!-- Start Rating -->
                                        <!-- <div class="rating">
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                            <div class="form-group">
                                                <label for="product_rating">{{ trans('Admin/products.rating_choose') }}</label>
                                                <select class="form-control"data-toggle="product_rating" id="product_rating" data-id="{{ $product->id }}" >
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <option value="{{$i}}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- End Rating -->

                                        <p>
                                            {{ $product->description }}
                                        </p>
                                        <div class="stock-info in-stock">
                                            <p class="availability">{{ __("Admin/site.status") }} :
                                                <b class="text {{ $product->in_stock ==1 ?'text-success':'text-danger' }}">
                                                    {{ $product->in_stock ==1 ? __("Admin/site.stock") : __("Admin/site.outstock") }}
                                                </b>
                                            </p>
                                        </div>
                                        <div class="stock-info in-stock">
                                            <p class="availability">
                                                <b
                                                    class="text text-success ">
                                                    @lang('Admin/site.qty') ({{ $product->qty  }})
                                                </b>
                                            </p>
                                        </div>
                                        {{-- <div class="widget widget--tags">
                                            <h4 class="h6 widget-title">Popular Tags</h4>

                                            <ul>
                                                @foreach ($product->tags as $tag)
                                                    <li><a href="#">{{$tag->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div> --}}

                                        @if (Auth::guard('vendor')->user() )
                                            @if($product->in_stock ==1)
                                                <form class="__add-to-cart" action="#">
                                                    <div class="quantity-counter js-quantity-counter">
                                                        <span class="__btn __btn--minus"  wire:click.prevent='decreaseQty' ></span>
                                                        <input class="__q-input"
                                                        type="text"
                                                        name="product-quatity"
                                                        min="1"
                                                        max="{{ $product->qty }}"
                                                        value="1"
                                                        onkeydown="return false"
                                                        wire:model='qty' />
                                                        <span class="__btn __btn--plus" wire:click.prevent='increaseQty' ></span>
                                                    </div>

                                                        <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                                        type="submit" role="button"
                                                        wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                                                        <i class="fontello-shopping-bag"></i>
                                                            {{ __('Admin/site.addtocart') }}
                                                        </button>

                                                        @if($witems->contains($product->id))
                                                            <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                                            type="submit" role="button"
                                                            wire:click.prevent=" removeWishlist({{ $product->id }})">
                                                            <i class="fa fa-heart fill-heart"></i>
                                                                {{ __('Admin/site.removewish') }}
                                                            </button>
                                                        @else
                                                            <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                                            type="submit" role="button"
                                                            wire:click.prevent=" addToWishlist({{ $product->id }},'{{ $product->name ? $product->name:' ' }}',{{ $product->price }}) ">
                                                                <i class="fa fa-heart"></i>
                                                                {{ __('Admin/site.addwish') }}
                                                            </button>
                                                        @endif
                                                </form>
                                            @endif
                                         @elseif(Auth::guard('web')->user())
                                            {{-- <a href="#" class="custom-btn custom-btn--medium custom-btn--style-2" style="margin-top:20px ">@lang('Website/home.vendor')</a> --}}
                                        @elseif(Auth::guard('admin')->user())
                                            {{-- <a href="#" class="custom-btn custom-btn--medium custom-btn--style-2" style="margin-top:20px ">@lang('Website/home.vendor')</a> --}}
                                        @else
                                            <a href="{{ route('user.login2') }}" class="custom-btn custom-btn--medium custom-btn--style-2" style="margin-top:20px ">@lang('Website/home.login')</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="spacer py-5 py-md-9"></div>

                                        <input type="hidden" id="show_comment_or_no" value="<?php echo Session::get('div_active');?>">

                                    <!-- start tab -->
                                    <div class="tab-container">
                                        <nav class="tab-nav">
                                            <a href="#" id="myDIV">Description</a>
                                            <!-- <a href="#" <?php /*if(Session::get('div_active')=='allow'){echo'class="active"';}*/?>>{{ __('website\comments.comments') }}</a> -->
                                            <a href="#" >{{ __('website\comments.comments') }}</a>
                                        </nav>


                                        <div class="tab-content">
                                            <div id="myDIV2" class="tab-content__item">
                                                <p>
                                                    {{ $product->description }}
                                                </p>


                                                <div class="description-table" style="max-width: 370px;">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Weight</td>
                                                                <td>1 kg</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Country of Origin</td>
                                                                <td>Agro Farm</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Quality</td>
                                                                <td>Organic</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Сheck</td>
                                                                <td>Healthy</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Min Weight</td>
                                                                <td>250 Kg</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- <div class="tab-content__item <?php /*if(Session::get('div_active')=='allow'){echo'is-visible';}*/?> "> -->
                                            <div class="tab-content__item ">
                                             <!-- ###################################################################3 -->
                                                <?php
                                                    $type='products';
                                                    $type_id=$product->id;
                                                ?>
                                                @include('livewire.front.comments')
                                            <!-- ###################################################################3 -->
                                            </div>





                                        </div>
                                    </div>
                                    <!-- end tab -->

                                    <div class="spacer py-5 py-md-9"></div>
                                </div>
                            </div>
                        </div>
                        <!-- start product single -->

                        <h2>{{ __('Admin/site.popproducts') }}</h2>
                        <div class="spacer py-2"></div>

                        <!-- start goods -->
                        <div class="goods goods--style-1">
                            <div class="__inner">
                                <div class="row">
                                    @foreach ($popProducts as $product)
                                    <!-- start item -->
                                    <div class="col-12 col-sm-6 col-lg-4">
                                        <div class="__item">
                                            <figure class="__image">
                                                <a href="{{ route('product_details',encrypt($product->id)) }}">
                                                    @if($product->image->filename)
                                                        <img  src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                                        data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                                    @else
                                                        <img  src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                        data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                    @endif

                                                </a>
                                            </figure>

                                            <div class="__content">
                                                <h4 class="h6 __title"><a href="{{ route('product_details',encrypt($product->id)) }}">{{ $product->name }}</a></h4>



                                              
                                                <div class="rating">
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item"><i class="fontello-star"></i></span>
                                                </div>
                                                <div class="stock-info in-stock">
                                                    <p class="availability">{{ __("Admin/site.status") }} :
                                                        <b class="text {{ $product->in_stock ==1 ?'text-success':'text-danger' }}">
                                                            {{ $product->in_stock ==1 ? __("Admin/site.stock") : __("Admin/site.outstock") }}
                                                        </b>
                                                    </p>
                                                </div>
                                                @if($product->special_price >0)
                                                    <div class="product-price">
                                                        <span class="product-price__item product-price__item--old">{{ number_format($product->price, 2) }} $</span>
                                                        <span class="product-price__item product-price__item--new">{{ number_format($product->special_price, 2) }} $</span>
                                                    </div>
                                                @else
                                                    <div class="product-price">
                                                        <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                                    </div>
                                                @endif
                                                @if (Auth::guard('vendor')->user() )
                                                @if($product->in_stock ==1)
                                                        {{-- wishlist route ******************* ***************************************--}}
                                                        <div class="product-wish">
                                                            @if($witems->contains($product->id))
                                                                <a href="#" wire:click.prevent=" removeWishlist({{ $product->id }}) ">
                                                                <i class="fa fa-heart fill-heart"></i>
                                                                </a>
                                                            @else
                                                            <a href="#"
                                                                wire:click.prevent=" addToWishlist({{ $product->id }},'{{ $product->name ? $product->name:' ' }}',{{ $product->price }}) ">
                                                                <i class="fa fa-heart"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                        {{-- wishlist route ******************* ***************************************--}}
                                                        <a class="custom-btn custom-btn--medium custom-btn--style-1" href="#"
                                                        wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})">
                                                            <i class="fontello-shopping-bag"></i>{{ __('Admin/site.addtocart') }}</a>
                                                @endif
                                                @endif
                                            </div>
                                            @if($product->special_price >0)
                                               <span class="product-label product-label--sale">{{ __('Admin/site.sale') }}</span>
                                            @else
                                               <span class="product-label product-label--new">{{ __('Admin/site.new') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end item -->
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!-- end goods -->

                    </div>

                    <div class="col-12 my-6 d-md-none"></div>

                    <div class="col-12 col-md-4 col-lg-3">
                        <aside class="sidebar">
                            <!-- start widget -->
                            {{-- <div class="widget widget--search">
                                <form class="form--horizontal" action="#" method="get">
                                    <div class="input-wrp">
                                        <input class="textfield" name="s" type="text" placeholder="Search" />
                                    </div>

                                    <button class="custom-btn custom-btn--tiny custom-btn--style-1" type="submit" role="button">Find</button>
                                </form>
                            </div> --}}
                            <!-- end widget -->

                            
                            @if(count($product->categories)>0)
                            <!-- start widget -->
                            <div class="widget widget--categories">
                                <h4 class="h6 widget-title">{{ __('website\search.Categories') }}</h4>
                                <ul class="list" id="blog_cates">
                                   @foreach($product->categories as $cate)
                                        @if($cate->parent_id==Null)
                                            <li class="list__item" id="{{$cate->id}}" onclick="javascript:search_result('products',this.id,'Category')" >
                                                <a class="list__item__link" >{{$cate->name}}</a>
                                                <span>({{count($cate->products)}})</span>
                                            </li>
                                            @if(count($cate->childs)>0)
                                                <?php
                                                $new = [
                                                    'page_name'=>'products',
                                                    'childs' => $cate->childs,
                                                    'padding' => 20,
                                                ];
                                                ?>
                                                @include('livewire.front.categoryChilds', $new)
                                            @endif
                                        @endif
                                    @endforeach
                                   
                                </ul>
                            </div>
                            <!-- end widget -->
                            @endif

                            @if(count($product->tags)>0)
                            <!-- start widget -->
                            <div class="widget widget--tags">
                                <h4 class="h6 widget-title">{{ __('website\search.Tags') }}</h4>

                                <ul id="all_tags">
                                    @foreach($product->tags as $tag)
                                    <li id="{{$tag->id}}" onclick="javascript:search_result('products',this.id,'Tag')"><a style="color:#36df33">{{$tag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end widget -->
                            @endif
                            

                            <!-- start widget -->
                            {{-- <div class="widget">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <button class="custom-btn custom-btn--medium custom-btn--style-1" role="button">Show Products</button>
                                    </div>

                                    <div class="col-auto">
                                        <a class="clear-filter" href="#">Clear all</a>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- end widget -->

                            <!-- start widget -->
                            <div class="widget widget--products">
                                <h4 class="h6 widget-title">{{ __('Admin/site.featproducts') }}</h4>

                                <ul>
                                    @foreach ($newProducts as $product)
                                    <li>
                                        <div class="row no-gutters">
                                            <div class="col-auto __image-wrap">
                                                <figure class="__image">
                                                    <a href="{{ route('product_details',encrypt($product->id)) }}">
                                                        @if($product->image->filename)
                                                            <img  src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}"
                                                            data-src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" alt="demo" />
                                                        @else
                                                            <img  src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                            data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                        @endif

                                                    </a>
                                                </figure>
                                            </div>

                                            <div class="col">
                                                <h4 class="h6 __title"><a href="{{ route('product_details',encrypt($product->id)) }}">{{ $product->name }}</a></h4>

                                                <div class="rating">
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item rating__item--active"><i class="fontello-star"></i></span>
                                                    <span class="rating__item"><i class="fontello-star"></i></span>
                                                </div>

                                                @if($product->special_price >0)
                                                <div class="product-price">
                                                    <span class="product-price__item product-price__item--old">{{ number_format($product->price, 2) }} $</span>
                                                    <span class="product-price__item product-price__item--new">{{ number_format($product->special_price, 2) }} $</span>
                                                </div>
                                            @else
                                                <div class="product-price">
                                                    <span class="product-price__item product-price__item--new">{{ number_format($product->price, 2) }} $</span>
                                                </div>
                                            @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end widget -->
                        </aside>
                    </div>
                </div>
            </div>
        </section>
        <!-- end section -->

        <!-- start section -->
        <section class="section section--no-pt section--no-pb section--gutter">
            <div class="container-fluid px-md-0">
                <!-- start banner simple -->
                <div class="simple-banner simple-banner--style-2" data-aos="fade" data-aos-offset="50">
                    <div class="d-none d-lg-block">
                        <img class="img-logo img-fluid  lazy" src="img/blank.gif" data-src="img/site_logo.png" alt="demo" />
                    </div>

                    <div class="row no-gutters">
                        <div class="col-12 col-lg-6">
                            <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_3.jpg" alt="demo" /></a>
                        </div>

                        <div class="col-12 col-lg-6">
                            <a href="#"><img class="img-fluid w-100  lazy" src="img/blank.gif" data-src="img/banner_bg_4.jpg" alt="demo" /></a>
                        </div>
                    </div>
                </div>
                <!-- end banner simple -->
            </div>
        </section>
        <!-- end section -->
</div>
<script>
    // this for show comments tab after adding and hide description tab

    let c=document.getElementById('show_comment_or_no').value;

    let element = document.getElementById("myDIV").classList;
   // alert(element);
    //element.classList.remove("active");

    let element2 = document.getElementById("myDIV2");
    //alert(element2);
   // element2.classList.remove("is-visible");
    element2.removeAttribute("visibility");
    //alert(c);
    //alert(element.classList);

</script>
