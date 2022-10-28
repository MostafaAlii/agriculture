@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/orders.orderPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">add_shopping_cart</i>
                    {{ trans('Admin/orders.orderPageTitle') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Orders.index') }}">{{ trans('Admin/orders.orderPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" style="text-decoration: none; color: black;">
                                    {{ trans('Admin/orders.order_details') }} / {{ $order->referance_id }}
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
        <!-- Start Content Body -->
        <div class="content-body">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow-none">
                    <!-- Start Order Update Status -->
                    @can('order-change-status')
                        <div class="card shadow mb-0">
                            <div class="card-header py-3 d-flex">
                                <div class="mr-auto">
                                    <form action="{{ route('Orders.update', encrypt($order->id)) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-row align-item">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text font-weight-bold font-weight-italic">{{ trans('Admin/orders.order_status') }}</div>
                                                            </div> <!-- onchange="this.form.submit()" -->
                                                            <select class="form-control form-control-md" id="manageOrderStatus" name="status">
                                                                <option value="">{{ trans('Admin/orders.order_status') }}</option>
                                                                <option value="0" {{ old('status', request()->input('status')) == '0' ? 'selected' : null }}>{{ trans('Admin/orders.ordered') }}</option>
                                                                <option value="1" {{ old('status', request()->input('status')) == '1' ? 'selected' : null }}>{{ trans('Admin/orders.deliverd_process') }}</option>
                                                                <option value="2" {{ old('status', request()->input('status')) == '2' ? 'selected' : null }}>{{ trans('Admin/orders.under_process') }}</option>
                                                                <option value="3" {{ old('status', request()->input('status')) == '3' ? 'selected' : null }}>{{ trans('Admin/orders.finish') }}</option>
                                                                <option value="4" {{ old('status', request()->input('status')) == '4' ? 'selected' : null }}>{{ trans('Admin/orders.order_reject') }}</option>
                                                                <option value="8" {{ old('status', request()->input('status')) == '8' ? 'selected' : null }}>{{ trans('Admin/orders.push_from_stock') }}</option>
                                                                <option value="5" {{ old('status', request()->input('status')) == '5' ? 'selected' : null }}>{{ trans('Admin/orders.canceled') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="rejectReason" style="display:none">
                                                        <label for="exampleFormControlTextarea1">{{ trans('Admin/orders.type_reject_reason') }}</label>
                                                        <textarea name="reason" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>

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
                    @endcan
                    <!-- End Order Update Status -->
                    <section id="collapsible" role="tablist">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12">
                                <!-- Start Order Details -->
                                <div class="card default-collapse collapse-icon accordion-icon-rotate">
                                    <!-- Start Order Details -->
                                    <a id="headingCollapse31" class="card-header bg-success" data-toggle="collapse" href="#collapse31" aria-expanded="true" aria-controls="collapse31">
                                        <div class="card-title lead white">
                                            <i class="ft-activity mr-50"></i>
                                            {{ trans('Admin/orders.order_items') }}
                                        </div>
                                    </a>
                                    <div id="collapse31" role="tabpanel" aria-labelledby="headingCollapse31" class="card-collapse collapse show" aria-expanded="true">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="col-lg-7 col-xl-7" style="width: 65%;float:right !important;">
                                                    @foreach ($order->orderItems as $item)
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <figure class="figure">
                                                                    @if ($item->product->image_path)
                                                                        <img src="{{ $item->product->image_path }}" alt="{{ $item->product->name .'_'. $item->order->referance_id }}" class="rounded-circle shadow bg-light rounded" style="width: 100px; height:100px;" />
                                                                    @else
                                                                        <img src="{{ asset('Dashboard/img/Default/default_product.jpg') }}" class="rounded-circle" style="width: 120px; height:120px;" />
                                                                    @endif
                                                                </figure>
                                                            </div>
                                                            <div class="col-md-9 mt-1">
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 mr-1 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/products.product_name') }}</label>
                                                                    <p class="col-md-4 mr-1 font-italic font-weight-bold">
                                                                        {{ $item->product->name}}
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 mr-1 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.product_price') }}</label>
                                                                    <p class="col-md-4 mr-1 font-italic font-weight-bold">
                                                                        <mark class="text-success">
                                                                            {{ $item->price . ' ' . $order->currency }}
                                                                        </mark>
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 mr-1 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.product_order_items_count') }}</label>
                                                                    <p class="col-md-4 mr-1 font-italic font-weight-bold">
                                                                        <u>{{ $item->quantity }}</u>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                                <div class="col-lg-5 col-xl-5 bg-success rounded" style="width: 35%;float:left !important;">
                                                    <div class="card">
                                                        <div class="card-header shadow-sm bg-white">
                                                            <h4 class="card-title">{!! trans('Admin/orders.detais') . ' ' . $order->getStatus() !!}</h4>
                                                        </div>
                                                        <div class="card-content collapse show">
                                                            <div class="card-body card-dashboard">
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 mr-2 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.order_referance') }}</label>
                                                                    <p class="col-md-5 mt-1 mr-0 font-italic">
                                                                            {{ $order->referance_id }}
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 mr-2 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.order_subTotal') }}</label>
                                                                    <p class="col-md-5 mt-1 mr-0 font-italic font-weight-bold">
                                                                        <mark class="text-success">
                                                                            {{ $order->subtotal . ' ' . $order->currency }}
                                                                        </mark>
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 mr-2 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.order_tax') }}</label>
                                                                    <p class="col-md-5 mt-1 mr-0 font-italic font-weight-bold">
                                                                        <mark class="text-success">
                                                                            {{ $order->tax }}
                                                                        </mark>
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 mr-2 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.order_discount') }}</label>
                                                                    <p class="col-md-5 mt-1 mr-0 font-italic font-weight-bold">
                                                                        <mark class="text-success">
                                                                            {{ $order->discount . ' ' . $order->currency }}
                                                                        </mark>
                                                                    </p>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-md-5 mr-2 col-form-label col-form-label-sm font-weight-bolder">{{ trans('Admin/orders.order_total') }}</label>
                                                                    <p class="col-md-5 mt-1 mr-0 font-italic font-weight-bold">
                                                                        <mark class="text-success">
                                                                            {{ $order->total . ' ' . $order->currency }}
                                                                        </mark>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Order Details -->
                                </div>
                                <!-- End Order Details -->
                                <!-- Start Billing Details -->
                                <div class="card default-collapse collapse-icon accordion-icon-rotate">
                                    <a id="headingCollapse32" class="card-header bg-danger" data-toggle="collapse" href="#collapse32" aria-expanded="false" aria-controls="collapse32">
                                        <div class="card-title lead white collapsed">
                                            <i class="ft-percent mr-50"></i>
                                            {{ trans('Admin/orders.billing_details') }}
                                        </div>
                                    </a>
                                    <div id="collapse32" role="tabpanel" aria-labelledby="headingCollapse32" class="card-collapse collapse" aria-expanded="false">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th>{{ trans('Admin/orders.order_vendor_name') }}</th>
                                                            <td>{{ $order->firstname .' '. $order->lastname }}</td>
                                                            <th>{{ trans('Admin/orders.order_vendor_email') }}</th>
                                                            <td>{{ $order->email }}</td>
                                                            <th>{{ trans('Admin/orders.order_vendor_phone') }}</th>
                                                            <td colspan="3">{{ $order->mobile }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ trans('Admin/orders.order_country') }}</th>
                                                            <td>{{ $order->country }}</td>
                                                            <th>{{ trans('Admin/orders.order_proviency') }}</th>
                                                            <td>{{ $order->province }}</td>
                                                            <th>{{ trans('Admin/orders.order_area') }}</th>
                                                            <td>{{ $order->area }}</td>
                                                            <th>{{ trans('Admin/orders.order_state') }}</th>
                                                            <td>{{ $order->state }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>{{ trans('Admin/orders.order_village') }}</th>
                                                            <td>{{ $order->village }}</td>
                                                            <th>{{ trans('Admin/orders.order_address_primary') }}</th>
                                                            <td colspan="5">{{ $order->address1 }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Billing Details -->
                                <!-- Start Shipping Details -->
                                <div class="card default-collapse collapse-icon accordion-icon-rotate">
                                    <a id="headingCollapse33" class="card-header bg-info" data-toggle="collapse" href="#collapse33" aria-expanded="false" aria-controls="collapse33">
                                        <div class="card-title lead white collapsed">
                                            <i class="ft-edit-2 mr-50"></i>
                                            {{ trans('Admin/orders.shipping_detais') }}
                                        </div>
                                    </a>
                                    <div id="collapse33" role="tabpanel" aria-labelledby="headingCollapse33" class="card-collapse collapse" aria-expanded="false">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        @if($order->is_shipping_different != 0)
                                                            <tr>
                                                                <th>{{ trans('Admin/orders.order_vendor_name') }}</th>
                                                                <td>{{ $order->shipping->firstname .' '. $order->shipping->lastname }}</td>
                                                                <th>{{ trans('Admin/orders.order_vendor_email') }}</th>
                                                                <td>{{ $order->shipping->email }}</td>
                                                                <th>{{ trans('Admin/orders.order_vendor_phone') }}</th>
                                                                <td colspan="3">{{ $order->shipping->mobile }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>{{ trans('Admin/orders.order_country') }}</th>
                                                                <td>{{ $order->shipping->country }}</td>
                                                                <th>{{ trans('Admin/orders.order_proviency') }}</th>
                                                                <td>{{ $order->shipping->province }}</td>
                                                                <th>{{ trans('Admin/orders.order_area') }}</th>
                                                                <td>{{ $order->shipping->area }}</td>
                                                                <th>{{ trans('Admin/orders.order_state') }}</th>
                                                                <td>{{ $order->shipping->state }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>{{ trans('Admin/orders.order_village') }}</th>
                                                                <td>{{ $order->shipping->village }}</td>
                                                                <th>{{ trans('Admin/orders.order_address_primary') }}</th>
                                                                <td colspan="5">{{ $order->shipping->address1 }}</td>
                                                            </tr>
                                                            @if($order->shipping->address2 != null)
                                                                <tr>
                                                                    <th>{{ trans('Admin/orders.order_address_secondry') }}</th>
                                                                    <td colspan="7">{{ $order->shipping->address2 }}</td>
                                                                </tr>
                                                            @endif
                                                             @else
                                                                <td class="font-weight-bold text-primary text-center mt-2">{{ trans('Admin/orders.shipping_data_is_billing_data') }}</td>

                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Shipping Details -->
                                <!-- Start Transaction Details -->
                                <div class="card default-collapse collapse-icon accordion-icon-rotate">
                                    <a id="headingCollapse34" class="card-header bg-warning" data-toggle="collapse" href="#collapse34" aria-expanded="false" aria-controls="collapse34">
                                        <div class="card-title lead white collapsed">
                                            <i class="ft-dollar-sign mr-50"></i>
                                            {{ trans('Admin/orders.transaction_detals') }}
                                        </div>
                                    </a>
                                    <div id="collapse34" role="tabpanel" aria-labelledby="headingCollapse34" class="card-collapse collapse" aria-expanded="false">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <th>{{ trans('Admin/orders.order_transaction_mode') }}</th>
                                                            <td>{!! $order->transaction->getTransaction() !!}</td>
                                                            <th>{{ trans('Admin/orders.order_transaction_status') }}</th>
                                                            <td>{!! $order->transaction->getStatus() !!}</td>
                                                            <th>{{ trans('Admin/orders.order_transaction_date') }}</th>
                                                            <td class="" colspan="3">{{ date('d F, Y', strtotime($order->transaction->created_at))  }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- End Transaction Details -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>
        <!-- End Content Body -->
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
<script>
    $(document).on('change','#manageOrderStatus',function(){
       if($(this).val() == '4' ){
            $('#rejectReason').show();
       }else{
           $('#rejectReason').hide();
       }
    });
</script>
@endsection
