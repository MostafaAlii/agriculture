@extends('dashboard.layouts.print')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
{{ trans('Admin/orders.order_invoice_details') }} / {{ $order->referance_id }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <h2>{{ trans('Admin/orders.order_invoice_details') }} / {{ $order->referance_id }}</h2>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ trans('Admin/orders.order_vendor_name') }}</th>
                                <td>{{ $order->firstname .' '. $order->lastname }}</td>
                                <th>{{ trans('Admin/orders.order_vendor_email') }}</th>
                                <td>{{ $order->email }}</td>
                                <th>{{ trans('Admin/orders.order_vendor_phone') }}</th>
                                <td colspan="2">{{ $order->mobile }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('Admin/orders.order_country') }}</th>
                                <td>{{ $order->country }}</td>
                                <th>{{ trans('Admin/orders.order_proviency') }}</th>
                                <td>{{ $order->province }}</td>
                                <th>{{ trans('Admin/orders.order_area') }}</th>
                                <td>{{ $order->area }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('Admin/orders.order_state') }}</th>
                                <td>{{ $order->state }}</td>
                                <th>{{ trans('Admin/orders.order_village') }}</th>
                                <td>{{ $order->village }}</td>
                            </tr>
                            <tr>
                                <th>{{ trans('Admin/orders.order_address_primary') }}</th>
                                <td colspan="5">{{ $order->address1 }}</td>
                            </tr>
                        </table>
                        <hr>
                        <h3>{{ trans('Admin/orders.order_items') }} / {{ trans('Admin/orders.shipping_detais') }}</h3>
                        <table class="table">
                            <thead>
                                <th></th>
                                <th>{{ trans('Admin/products.product_name') }}</th>
                                <th>{{ trans('Admin/orders.product_price') }}</th>
                                <th>{{ trans('Admin/orders.product_order_items_count') }}</th>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td width="5%">{{ $loop->iteration }}</td>
                                        <td width="25%">{{ $item->product->name }}</td>
                                        <td width="10%">{{ $item->product->price }}</td>
                                        <td width="5%">{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <br>
                            <tbody>
                                
                                @if($order->is_shipping_different != 0)
                                    <tr>
                                        <td width="25%"><h3>{{ trans('Admin/orders.shipping_detais') }}</h3></td>
                                    </tr>
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
                                    </tr>
                                    <tr>
                                        <th>{{ trans('Admin/orders.order_state') }}</th>
                                        <td>{{ $order->shipping->state }}</td>
                                        <th>{{ trans('Admin/orders.order_village') }}</th>
                                        <td>{{ $order->shipping->village }}</td>
                                    </tr>
                                    <tr>
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
                                    <tr>
                                        <th>{{ trans('Admin/orders.shipping_detais') }}</th>
                                        <td colspan="5">{{ trans('Admin/orders.shipping_data_is_billing_data') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                            <hr>
                            <tfoot>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_transaction_mode') }}</th>
                                    <td>{!! $order->transaction->getTransactionForPrint() !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_transaction_status') }}</th>
                                    <td>{!! $order->transaction->getStatusForPrint() !!}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_transaction_date') }}</th>
                                    <td>{{ date('d F, Y', strtotime($order->transaction->created_at))  }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_subTotal') }}</th>
                                    <td>{{ $order->subtotal  }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_tax') }}</th>
                                    <td>{{ $order->tax . ' ' . '(' . config('cart.tax') . '%)'  }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_discount') }}</th>
                                    <td>{{ $order->discount . ' ' . $order->currency }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <th colspan="1">{{ trans('Admin/orders.order_total') }}</th>
                                    <td>{{ $order->total . ' ' . $order->currency }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

@section('js')
<script>
    window.print();
</script>
@endsection