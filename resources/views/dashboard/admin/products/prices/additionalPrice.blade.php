@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/products.productPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12">
                <h3 class="content-header-title">{{trans('Admin\products.add_special_price')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('products') }}">{{ __('Admin/products.productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" style="text-decoration: none; color: black;">
                                {{ __('Admin/products.specialPricePageTitle') }} / {{ $product->name }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="float-right media width-250">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts mx-auto">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/products.add_special_price') }}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="mb-0 list-inline">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" method="post" action="{{ route('products.prices.store') }}">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">
                                            <!-- Start Tags Multi Select -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="hidden" name="product_id" value="{{ encrypt($product->id) }}" />
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_price_select') }}
                                                        </label>
                                                        <select name="special_price_type" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_price_select_placeholder') }}">
                                                                <option value="precent">{{ __('Admin/products.precent') }}</option>
                                                                <option value="fixed">{{ __('Admin/products.fixed') }}</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('special_price_type')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_private_price') }}
                                                        </label>
                                                        <input type="number" name="price" class="form-control" placeholder="{{ trans('Admin/products.product_private_price') }}" />
                                                        @error('price')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Tags Multi Select -->

                                            <!-- Start Dates -->
                                            <div class="row" >
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('Admin\products.product_start_date_offer') }}</label>
                                                        <input type="date" id="start_date" name="special_price_start" class="form-control form-control-md form-control-solid" placeholder="{{ trans('Admin\products.product_start_date_offer') }}" value="{{old('special_price_start')}}"  />

                                                        @error('special_price_start')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{ trans('Admin\products.product_end_date_offer') }}</label>
                                                        <input type="date" id="end_date" name="special_price_end" class="form-control form-control-md form-control-solid" placeholder="{{ trans('Admin\products.product_end_date_offer') }}" value="{{old('special_price_end')}}"  />
                                                        @error('special_price_end')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Dates -->

                                            <hr>
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
