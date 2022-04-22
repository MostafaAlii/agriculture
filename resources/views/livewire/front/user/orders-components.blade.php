<div>
    <div class="my-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
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
                    <tr wire:key="{{ $order->id }}">
                        <td>{{ $order->referance_id }}</td>
                        <td>{{ $order->currency() . ' ' . $order->subtotal }}</td>
                        <td>{{ $order->currency() . ' ' . $order->total }}</td>
                        <td>{{ $order->currency() . ' ' . $order->discount }}</td>
                        <td>{!! $order->getStatus() !!}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        <td class="text-right">
                            <button type="button" class="btn btn-success btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <p class="text-center">{{ trans('Website/vendor/orders.no_data_found') }}</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
