@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ __('Admin/site.farmerproductdetails') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                {{-- <h3 class="content-header-title">
                    {{ $product->name }}</h3> --}}
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('farmers.index') }}">{{ __('Admin/site.farmer') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('farmers.index') }}">{{ __('Admin/site.farmerproducts') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section class="users-view">
                <div class="row">
                    <div class="col-12 col-sm-7">
                        <div class="media mb-2">
                            @if ($product->image->filename)
                                <img src="{{ asset('Dashboard/img/products/' . $product->image->filename) }}"
                                    class="rounded-circle  height-150" alt="Card image" />
                            @else
                                <img src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                    class="rounded-circle  height-150" alt="Card image" />
                            @endif
                            <div class="media-body pt-25">
                                <h3 class="media-heading"><span class="users-view-name">{{ $product->name }} </span> </h3>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="col-12">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>{{ __('Admin/products.product_name') }}:</td>
                                            <td class="users-view-username">{{ $product->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Admin/products.product_description') }}:</td>
                                            <td class="users-view-username">{{ $product->description }}</td>
                                        </tr>
                                        @if ($product->special_price > 0)
                                            <tr>
                                                <td>{{ __('Admin/products.product_price_original') }}:</td>
                                                <td class="users-view-name">
                                                    <div class="product-price">
                                                        <h4 class="pricing-card-title"><s>{{ number_format($product->price, 2) }} $</s></h4>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{ __('Admin/products.product_price_sale') }}:</td>
                                                <td class="users-view-name">
                                                    <div class="product-price">
                                                        <h4 class="pricing-card-title">{{ number_format($product->special_price, 2) }} $</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ __('Admin/products.product_price_original') }}:</td>
                                                <td class="users-view-name">
                                                    <div class="product-price">
                                                        <h4 class="pricing-card-title">{{ number_format($product->price, 2) }} $</h4>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td> @lang('Admin/site.qty'):</td>
                                            <td class="users-view-email">{{ $product->qty  }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Admin/products.product_status') }}:</td>
                                            <td>
                                                <b
                                                class="text {{ $product->in_stock == 1 ? 'text-success' : 'text-danger' }}">
                                                {{ $product->in_stock == 1 ? __('Admin/site.stock') : __('Admin/site.outstock') }}
                                            </b>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                {{-- <h5 class="mb-1"><i class="ft-link"></i> Social Links</h5>
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>Twitter:</td>
                                            <td><a href="#">https://www.twitter.com/</a></td>
                                        </tr>
                                        <tr>
                                            <td>Facebook:</td>
                                            <td><a href="#">https://www.facebook.com/</a></td>
                                        </tr>
                                        <tr>
                                            <td>Instagram:</td>
                                            <td><a href="#">https://www.instagram.com/</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <h5 class="mb-1"><i class="ft-info"></i> Personal Info</h5>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Birthday:</td>
                                            <td>03/04/1990</td>
                                        </tr>
                                        <tr>
                                            <td>Country:</td>
                                            <td>USA</td>
                                        </tr>
                                        <tr>
                                            <td>Languages:</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Contact:</td>
                                            <td>+(305) 254 24668</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- END: Content-->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js"
        integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js"
        integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
