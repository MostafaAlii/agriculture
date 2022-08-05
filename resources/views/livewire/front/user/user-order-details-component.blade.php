@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('title')
    {{ trans('Website/vendor/dashboard.dashboardPageTitle') . ' / ' . trans('Website/vendor/dashboard.my_orders') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper py-3">
        <div class="content-header row"></div>
        <div class="content-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pt-lg-3 mt-5">
                        <h4 class="card-title shadow p-3 mb-5 bg-white rounded">
                            <i class="fa fa-tachometer" aria-hidden="true"> </i>
                            {{ trans('Website/vendor/dashboard.dashboardPageTitle') . ' / ' . \Auth::user()->firstname . ' ' .\Auth::user()->lastname }}
                        </h4>
                        <hr>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body card-dashboard">
                            <section class="py-3">
                                <div class="row">
                                    <div class="col-lg-4" style="width: 35%;float:left !important;">
                                        @include('front.layouts.include.client.sidebar')
                                    </div>
                                    <div class="col-lg-8 shadow p-3 mb-5 bg-white rounded" style="min-height:35%;width: 65%;float:right !important;">
                                        <div class="container shadow p-3 mb-5 bg-white rounded">
                                            <h4>
                                                <i class="fa fa-bars" aria-hidden="true"></i>
                                                {{ trans('Website/vendor/dashboard.my_orders') }} :
                                            </h4>
                                            <!-- Order Details Component -->
                                            <!-- Start Order Details -->
                                            <div class="border rounded shadow p-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h5>{{ trans('Website/vendor/orders.order_details') }}</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="panel-body">
                                                                <table class="table">
                                                                    <th>{{ trans('Website/vendor/orders.order_ref') }}</th>
                                                                    <td>{{ $order->referance_id }}</td>
                                                                    <th>{{ trans('Website/vendor/orders.order_date') }}</th>
                                                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                                                    <th>{{ trans('Website/vendor/orders.order_status') }}</th>
                                                                    <td>{!! $order->getStatus() !!}</td>
                                                                    @if($order->status == Order::DELIVERED) <!-- تم الشحن -->
                                                                        <th>{{ trans('Website/vendor/orders.order_delivered_date') }}</th>
                                                                        <td>{{ $order->suggestion_delivered_date->format('d-m-Y') }}</td>
                                                                    @elseif($order->status == Order::UNDER_PROCESS)
                                                                        <th>{{ trans('Website/vendor/orders.order_under_process_date') }}</th>
                                                                        <td>{{ $order->under_proces_date->format('d-m-Y') }}</td>
                                                                    @elseif($order->status == Order::FINISHED)
                                                                        <th>{{ trans('Website/vendor/orders.order_finish_process_date') }}</th>
                                                                        <td>{{ $order->delivered_date->format('d-m-Y') }}</td>
                                                                    @elseif($order->status == Order::REJECTED)
                                                                        <th>{{ trans('Website/vendor/orders.order_reject_reason') }}</th>
                                                                        <td>{!! $order->reason !!}</td>
                                                                    @elseif($order->status == Order::PUSH_FROM_STOCK)
                                                                        <th>{{ trans('Website/vendor/orders.order_push_from_stock_process_date') }}</th>
                                                                        <td>{{ $order->push_from_stock_date->format('d-m-Y') }}</td>
                                                                    @elseif($order->status == Order::CANCELED)
                                                                        <th>{{ trans('Website/vendor/orders.order_canceled_date') }}</th>
                                                                        <td>{{ $order->canceled_date->format('d-m-Y') }}</td>
                                                                    @endif
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="table-responsive mb-4">
                                                    <table class="table">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">{{ trans('Website/vendor/orders.product') }}</strong></th>
                                                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">{{ trans('Website/vendor/orders.price') }}</strong></th>
                                                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">{{ trans('Website/vendor/orders.quantity') }}</strong></th>
                                                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">{{ trans('Website/vendor/orders.total') }}</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($order->orderItems as $item)
                                                                <tr>
                                                                    <td>
                                                                        @if($item->product->image)
                                                                            <img src="{{ asset('Dashboard/img/products/'. $item->product->image->filename) }}" style="width: 75px;" alt="">
                                                                        @else
                                                                            <img src="{{ asset('Dashboard/img/images/products/default.jpg') }}" style="width: 75px;" alt="">
                                                                        @endif
                                                                        <a href="{{ route('product_details', encrypt($item->product->id)) }}">
                                                                            {{ $item->product->name }}
                                                                        </a>

                                                                    </td>
                                                                    <td>{{ $order->currency() . ' ' . number_format($item->price, 2) }}</td>
                                                                    <td>{{ $item->quantity }}</td>
                                                                    <td>{{ $order->currency() . ' ' . number_format($item->price * $item->quantity, 2) }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>{{ trans('Website/vendor/orders.subtotal') }}</strong></td>
                                                                <td>{{ $order->currency() . ' ' . number_format($order->subtotal, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>{{ trans('Website/vendor/orders.discount') }}</strong></td>
                                                                <td>{{ $order->currency() . ' ' . number_format($order->discount, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>{{ trans('Website/vendor/orders.tax') }}</strong></td>
                                                                <td>{{ $order->currency() . ' ' . number_format($order->tax, 2) }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" class="text-right"><strong>{{ trans('Website/vendor/orders.amount') }}</strong></td>
                                                                <td>{{ $order->currency() . ' ' . number_format($order->total, 2) }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <h2 class="h5 text-uppercase">{{ trans('Website/vendor/orders.transactions') }}</h2>
                                                <div class="table-responsive mb-4">
                                                    <table class="table bg-light">
                                                        <tbody>
                                                            <tr>
                                                                <th>{{ trans('Website/vendor/orders.transactions_mode') }}</th>
                                                                <td>{!! $order->transaction->getTransaction() !!}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>{{ trans('Website/vendor/orders.transactions_date') }}</th>
                                                                <td>{{$order->transaction->created_at->format('d-m-Y')}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- End Order Details -->
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
