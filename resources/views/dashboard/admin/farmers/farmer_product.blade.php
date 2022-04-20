@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
        integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ __('Admin/site.farmerproducts') }}
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/site.product') }}
                    {{ $farmer->firstname . $farmer->lastname }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('farmers.index') }}">{{ __('Admin/site.farmer') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">{{ __('Admin/site.farmerproducts') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="simple-user-cards" class="row">
                <div class="col-12">
                    <h4 class="text-uppercase">{{ __('Admin/site.product') }}
                        {{ $farmer->firstname . $farmer->lastname }}</h4>
                    <h1 style="color: #e71d1d">{{ $farmer->products->count() }} {{ __('Admin/site.product') }}</h1>
                </div>
                @if ($farmer->products->count() > 0)
                    @foreach ($far as $product)
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card">
                                <div class="text-center">
                                    <div class="card-body">
                                        <a href="{{ route('farmer.product.detailspage', encrypt($product->id)) }}">
                                            @if ($product->image->filename)
                                                <img src="{{ asset('Dashboard/img/products/' . $product->image->filename) }}"
                                                    class="rounded-circle  height-150" alt="Card image" />
                                            @else
                                                <img src="{{ asset('Dashboard/img/images/products/default.jpg') }}"
                                                    class="rounded-circle  height-150" alt="Card image" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><a href="">{{ $product->name }}</a></h4>
                                    </div>
                                    <div class="text-center">
                                        @if ($product->special_price > 0)
                                            <div class="product-price">
                                                <h1 class="pricing-card-title">
                                                    <b><s>{{ number_format($product->price, 2) }} $</s></b></h1>
                                                <h1 class="pricing-card-title">
                                                    {{ number_format($product->special_price, 2) }} $</h1>
                                            </div>
                                        @else
                                            <div class="product-price">
                                                <h1 class="pricing-card-title">{{ number_format($product->price, 2) }} $
                                                </h1>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h3 style="color: #e71d1d;"> ({{ __('Admin/site.no_data_found') }})</h3>
                @endif
            </section>
            {{-- <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#"
                            aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">
                            Previous</a></li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0"
                            class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0"
                            class="page-link">2</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0"
                            class="page-link">3</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="4" tabindex="0"
                            class="page-link">4</a>
                    </li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="5"
                            tabindex="0" class="page-link">5</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="6"
                            tabindex="0" class="page-link">6</a></li>
                    <li class="paginate_button page-item next" id="DataTables_Table_0_next"><a href="#"
                            aria-controls="DataTables_Table_0" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                    </li>
                </ul>
            </div> --}}


                {{ $far->links() }}

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
