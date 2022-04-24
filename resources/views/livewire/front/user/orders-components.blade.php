<div x-data="{ showOrder: @entangle('showOrder') }">
    <!-- Start d-flex justify-content-between -->
    <div class="d-flex justify-content-between align-content-center mb-2">
        <!-- Start d-flex -->
        <div class="d-flex">
            {{-- dd($orders) --}}
            <div>
                <div class="d-flex align-items-center ml-4 form-group">
                    <label for="paginate" class="text-nowrap mr-2 mb-0"> Per Page </label>
                    <select wire:model="paginate" name="paginate" id="paginate" class="form-control form-control-md" autocomplete="off">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="d-flex align-items-center ml-4">
                    <label for="paginate" class="text-nowrap mr-2 mb-0">FilterBy Status</label>
                    <select class="form-control form-control-sm" wire:model="selectedStatus">
                            <option value="">{{ trans('Admin/orders.order_status') }}</option>
                            <option value="ordered"> {{ trans('Admin/orders.ordered') }} </option>
                            <option value="delivered"> {{ trans('Admin/orders.deliverd') }} </option>
                            <option value="canceled"> {{ trans('Admin/orders.canceled') }} </option>
                    </select>
                </div>
            </div>
            {{-- $selectedStatus --}}
            <div>
                @if ($checked)
                <div class="dropdown ml-4">
                    <button class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown"> With Checked
                        ({{ count($checked) }})</button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item" type="button"
                            onclick="confirm('Are you sure you want to export these Records?') || event.stopImmediatePropagation()"
                            wire:click="exportSelected()">
                            Export
                        </a>

                    </div>
                </div>
                @endif
            </div>
        </div>
        <!-- End d-flex -->
        <!-- Start Searchbar -->
        <div class=" col-md-4">
            <input type="search" wire:model.debounce.500ms="search" class="form-control"
                placeholder="Search by name,email,phone,or address...">
        </div>
        <!-- End Searchbar -->
    </div>
    {{-- $search --}}
    @if(Session::has('order_message'))
        <div class="alert aler-danger" >
            {{ Session::get('order_message') }}
        </div>
    @endif
    <!-- End d-flex justify-content-between -->
    <div class="card-body table-responsive p-0">
        <div class="table table-hover">
            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" wire:model="selectPage"></th>
                    <th>{{ __('Admin/orders.order_referance') }}</th>
                    <th>{{ __('Admin/orders.order_subTotal') }}</th>
                    <th>{{ __('Admin/orders.order_total') }}</th>
                    <th>{{ __('Admin/orders.order_discount') }}</th>
                    <th>{{ __('Admin/orders.order_status') }}</th>
                    <th>{{ __('Admin/orders.order_date') }}</th>
                    <th class="col-2">{{ __('Admin/site.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr wire:key="{{ $order->id }}"  {{--  class="@if($this->isChecked($order->id)) table-primary @endif"--}}>
                        <td><input type="checkbox" value="{{ $order->id }}" wire:model="checked"></td>
                        <td>{{ $order->referance_id }}</td>
                        <td>{{ $order->currency() . ' ' . $order->subtotal }}</td>
                        <td>{{ $order->currency() . ' ' . $order->total }}</td>
                        <td>{{ $order->currency() . ' ' . $order->discount }}</td>
                        <td>{!! $order->getStatus() !!}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td class="text-right">
                            <button type="button" wire:click="displayOrder('{{ $order->id }}')" x-on:click="showOrder = true" class="btn btn-success btn-sm">
                                <i class="fa fa-eye"> </i> 
                            </button>
                            @if($order->status == Order::ORDERED)
                                <button class="btn btn-danger btn-sm" type="button" wire:click="cancelOrder('{{ $order->id }}')">
                                    <i class="fontello-cancel"> </i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td class="align-center mt-5">
                            <p class="text-danger">{{ trans('Website/vendor/orders.no_data_found') }}</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
            <!-- Start Order Details -->
            <div x-show="showOrder" x-on:click.away="showOrder = false" class="border rounded shadow p-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Order Details</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <table class="table">
                                    <th>Order Ref</th>
                                    <td>{{ $order->referance_id }}</td>
                                    <th>Order Date</th>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <th>Order Status</th>
                                    <td>{!! $order->getStatus() !!}</td>
                                    @if($order->status == Order::DELIVERED)
                                        <th>Delivered Date</th>
                                        <td>{{ $order->delivered_date }}</td>
                                    @elseif($order->status == Order::CANCELED)
                                        <th>Canceled Date</th>
                                        <td>{{ $order->canceled_date }}</td>
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
                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">Product</strong></th>
                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">Price</strong></th>
                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">Quantity</strong></th>
                                <th class="border-0" scope="col"><strong class="text-small text-uppercase">Total</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td>
                                        @if($item->product->image->filename)
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
                                    <td>{{ $order->currency() . ' ' . number_format($item->product->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                                <td>{{ $order->currency() . ' ' . number_format($order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Discount</strong></td>
                                <td>{{ $order->currency() . ' ' . number_format($order->discount, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Tax</strong></td>
                                <td>{{ $order->currency() . ' ' . number_format($order->tax, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Amount</strong></td>
                                <td>{{ $order->currency() . ' ' . number_format($order->total, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h2 class="h5 text-uppercase">Transactions</h2>
                <div class="table-responsive mb-4">
                    <table class="table bg-light">
                        <tbody>
                            <tr>
                                <th>Transaction Mode</th>
                                <td>{!! $order->transaction->getTransaction() !!}</td>
                            </tr>
                            <tr>
                                <th>Transaction Date</th>
                                <td>{{$order->transaction->created_at->format('d-m-Y')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- End Order Details -->
    </div>
    <!-- Start Pagination -->
    <div class="row mt-4">
        <div class="col-sm-6 offset-5">
            {{ $orders->links() }}
        </div>
    </div>
    <!-- End Pagination -->
</div>
