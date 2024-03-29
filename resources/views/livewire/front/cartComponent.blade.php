@section('title', __('website\home.cart'))
@section('css')
<style>
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
@endsection
<div>
    <!-- start section -->
    <section class="section">
        <div class="decor-el decor-el--1" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="286" height="280" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_1.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--2" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="99" height="88" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_2.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--3" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="115" height="117" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_3.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--4" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="84" height="76" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_4.jpg') }}" alt="demo" />
        </div>

        <div class="decor-el decor-el--5" data-jarallax-element="-70" data-speed="0.2">
            <img class="lazy" width="248" height="309" src="{{ asset('frontassets/img/blank.gif') }}"
                data-src="{{ asset('frontassets/img/decor-el_5.jpg') }}" alt="demo" />
        </div>

        <div class="container">
            <a href="{{ route('shop') }}" class="custom-btn custom-btn--medium custom-btn--style-1" role="button">
                @lang('Admin/site.back')
            </a>
            <div class="row">

                <div class="col-12">

                    <!-- start cart -->
                    <div class="cart">
                        <form class="cart__form" action="#">
                            <div class="cart__table">
                                <table>
                                    <thead>
                                        <tr>
                                            <td width="10%">&nbsp;</td>
                                            <td width="35%">{{ __('Website/home.addedproduct') }}</td>
                                            <td width="15%">{{ __('Website/home.price') }}</td>
                                            <td width="15%">{{ __('Website/home.unit') }}</td>
                                            <td width="15%">{{ __('Admin/site.farmername') }}</td>
                                            <td width="20%">{{ __('Website/home.quantity') }}</td>
                                            <td width="15%">{{ __('Website/home.total') }}</td>
                                            <td width="5%">{{ __('Website/home.delete') }}</td>
                                            <td width="5%">&nbsp;</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (Session::has('success_message'))
                                            <div class="alert alert-success">
                                                 {{ Session::get('success_message') }}
                                            </div>
                                        @endif
                                        @if (Cart::instance('cart')->count() > 0)
                                        <button class="custom-btn custom-btn--medium custom-btn--style-2"
                                                    wire:click.prevent="destroyAll()" >{{ __('Admin/site.bulk_delete') }}
                                                    <i class="fontello-cancel" style="color: #e71d1d"></i>
                                        </button>
                                            @foreach (Cart::instance('cart')->content() as $item)
                                                <tr>
                                                    <td>
                                                        <figure class="__image">
                                                            <a href="{{ route('product_details', encrypt($item->model->id)) }}">
                                                                <img  src=" {{ $item->model->image_path ?
                                                                $item->model->image_path : URL::asset('Dashboard/img/Default/default_product.jpg') }}"
                                                                alt="{{ $item->model->name}}">
                                                            </a>
                                                        </figure>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('product_details', encrypt($item->model->id)) }}"
                                                            class="__name">{{ $item->model->name }}</a>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="__price">{{ $item->model->special_price ? number_format($item->model->special_price,2) : number_format($item->model->getPrice(), 2)}}  {{ config('app.Currency') }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="__price">{{ $item->model->getUnit()->Name}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="__name">{{$item->model->farmer->firstname }} {{$item->model->farmer->lastname }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <div class="quantity-counter js-quantity-counter">
                                                            @if($item->qty > 1)
                                                                <span class="__btn __btn--minus"
                                                                wire:click.prevent="decreaseQuntity('{{ $item->rowId }}')"></span>
                                                            @endif

                                                            <input class="__q-input" type="text"
                                                                name="product-quatity"
                                                                min="1"
                                                                max="{{ $item->model->qty }}"
                                                                value="{{ $item->qty }}"
                                                                onkeydown="return false"
                                                                autocomplete="off" />

                                                            @if($item->qty < $item->model->qty)
                                                                <span class="__btn __btn--plus"
                                                                wire:click.prevent="increaseQuntity('{{ $item->rowId }}')"></span>
                                                            @endif


                                                            {{--<a href="#"
                                                                class="__name" style="color: #e71d1d;"
                                                                wire:click.prevent='SaveForLater("{{ $item->rowId }}")'>{{ __('Admin/site.savelater') }}
                                                            </a>--}}
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <span
                                                            class="__total">{{ number_format($item->subtotal, 2) }}  {{ config('app.Currency') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <a class="__remove" href="#" aria-label="Remove this item"
                                                            wire:click.prevent="destroy('{{ $item->rowId }}')">
                                                            <i class="fontello-cancel"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                        <h3 style="color: #e71d1d;"> ({{ __('Admin/site.no_data_found') }})</h3>
                                       <h3> <a class="__name" href="{{ route('shop') }}" class="btn btn-success">{{ __('website\home.shop') }}</a>
                                        <i class="fa fa-car"></i>
                                       </h3>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="py-5"></div>

                            <div class="row justify-content-md-between">


                                <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                                    <div class="spacer py-5 d-md-none"></div>

                                    <div class="cart__total">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <td colspan="2">
                                                        <h3>{{ __('Website/home.cart') }} <span>{{ __('Website/home.total') }}</span></h3>
                                                    </td>
                                                </tr>
                                            </thead>
                                            @if (Cart::instance('cart')->total() > 0 )
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">
                                                            <a class="custom-btn custom-btn--medium custom-btn--style-1"
                                                                href="{{ route('checkout') }}">{{ __('Website/home.Proceedtocheckout') }}</a>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            @endif
                                            <tbody>
                                                <tr>
                                                    <td>{{ __('Website/home.subtotal') }}:</td>
                                                    <td> {{ config('app.Currency') }}{{ Cart::instance('cart')->subtotal() }}</td>
                                                </tr>

                                                <tr>
                                                    <td>{{ __('Website/home.tax') }}</td>
                                                    <td>  {{ config('app.Currency') }}{{ Cart::instance('cart')->tax() }}</td>
                                                </tr>

                                                <tr>
                                                    <td>{{ __('Website/home.total') }}</td>
                                                    <td> {{ config('app.Currency') }}{{ Cart::instance('cart')->total() }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if(!Cart::instance('saveforlater')->count() == null)


                                <h2>{{ __('Admin/site.savelater') }}</h2>
                                <div class="spacer py-2"></div>

                                <!-- start goods -->
                                <div class="goods goods--style-1">
                                    <h3 class="title-box"
                                    style="border-bottom: 1px solid; padding: 13px 18px; background-color: #ff2832; color: #fefefe; text-transform: uppercase; font-size: 14px; line-height: 14px;">
                                    {{ __('Admin/site.itemsave') }}
                                    <strong style="font-size: 20px">{{ Cart::instance('saveforlater')->count() }}</strong>
                                    {{ __('Admin/site.inbox') }}
                                </h3>
                                    @if(Session::has('s_success_message'))
                                        <div class="alert alert-success">
                                            <strong>Success </strong> {{ Session::get('s_success_message') }}
                                        </div>
                                    @endif
                                    <div class="__inner">
                                        <div class="row">
                                            @if(Cart::instance('saveforlater')->count() > 0)
                                                @foreach (Cart::instance('saveforlater')->content() as $product)
                                                <!-- start item -->
                                                    <div class="col-12 col-sm-6 col-lg-3">
                                                        <div class="__item">
                                                            <figure class="__image">
                                                                <a href="{{ route('product_details',encrypt($product->model->id)) }}">
                                                                    @if($product->model->image)
                                                                        <img  src="{{ asset('Dashboard/img/products/'. $product->model->image->filename) }}"
                                                                        data-src="{{ asset('Dashboard/img/products/'. $product->model->image->filename) }}" alt="demo" />
                                                                    @else
                                                                        <img  src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                                        data-src="{{ asset('Dashboard/img/images/products/default.jpg') }}" alt="demo" />
                                                                    @endif

                                                                </a>
                                                            </figure>

                                                            <div class="__content">
                                                                <h4 class="h6 __title"><a href="{{ route('product_details',encrypt($product->model->id)) }}">{{ $product->model->name }}</a></h4>

                                                                <span class="score"><span style="width:<?php echo $product->model->productRate();?>%"></span></span>

                                                                <div class="stock-info in-stock">
                                                                    <p class="availability">{{ __("Admin/site.status") }} :
                                                                        <b class="text {{ $product->model->stock ==1 ?'text-success':'text-danger' }}">
                                                                            {{ $product->model->stock ==1 ? __("Admin/site.stock") : __("Admin/site.outstock") }}
                                                                        </b>
                                                                    </p>
                                                                </div>
                                                                @if ($product->model->special_price > 0)
                                                                        <div class="product-price">
                                                                            <span
                                                                                class="product-price__item product-price__item--old">
                                                                                {{ number_format($product->model->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                            <span
                                                                                class="product-price__item product-price__item--new">
                                                                                {{ number_format($product->model->special_price, 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <div class="product-price">
                                                                            <span
                                                                                class="product-price__item product-price__item--new">
                                                                                {{ number_format($product->model->getPrice(), 2) }}  {{ config('app.Currency') }}
                                                                                {{ $product->model->getUnit()->Name }}
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                                <button class="custom-btn custom-btn--medium custom-btn--style-1"
                                                                wire:click.prevent=' moveProductFromSaveForLaterToCart("{{ $product->rowId }}")' > {{ __('Admin/site.addtocart') }}
                                                                </button>
                                                                <a class="__remove" href="#" aria-label="Remove this item"
                                                                wire:click.prevent="DeleteFromSaveForLater('{{ $product->rowId }}')"
                                                                style="color: #e71d1d; font-size: 20px; padding: 10px;">
                                                                <i class="fontello-cancel"></i>
                                                                </a>
                                                            </div>
                                                            @if($product->model->special_price >0)
                                                            <span class="product-label product-label--sale">{{ __('Admin/site.sale') }}</span>
                                                            @else
                                                            <span class="product-label product-label--new">{{ __('Admin/site.new') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                <!-- end item -->
                                                @endforeach
                                            @else
                                            <h3 style="color: #e71d1d;"> ({{ __('Admin/site.no_data_found') }})</h3>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <!-- end goods -->
                            {{-- @else
                            <h2>{{ __('Admin/site.no_data_found') }}</h2> --}}
                            @endif
                        </form>
                    </div>
                    <!-- start cart -->

                </div>
            </div>
        </div>
    </section>
    <!-- end section -->


</div>
