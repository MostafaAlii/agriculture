<div>
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
                            <a href="{{ route('vendor.orderDetais', ['order_id'=>encrypt($order->id)]) }}" class="btn btn-success btn-sm">
                                <i class="fa fa-eye"> </i> 
                            </a>
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
    </div>
    <!-- Start Pagination -->
    <div class="row mt-4">
        <div class="col-sm-6 offset-5">
            {{ $orders->links() }}
        </div>
    </div>
    <!-- End Pagination -->
</div>
