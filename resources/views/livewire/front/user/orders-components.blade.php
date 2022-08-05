<div>
    <!-- Start d-flex justify-content-between -->
    <div class="d-flex justify-content-between align-content-center mb-2">
        <!-- Start d-flex -->
        <div class="d-flex">
            {{-- dd($orders) --}}
            <div>
                <div class="d-flex align-items-center ml-4 form-group">
                    <label for="paginate" class="text-nowrap mr-2 mb-0"> {{__('Website/vendor/dashboard.per_page')}}</label>
                    <select wire:model="paginate" name="paginate" id="paginate" class="form-control form-control-md" autocomplete="off">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="d-flex align-items-center ml-4">
                    <label for="paginate" class="text-nowrap mr-2 mb-0">{{__('Website/vendor/dashboard.status_filter')}}</label>
                    <select class="form-control form-control-sm" wire:model="selectedStatus">
                            <option value="">{{ trans('Admin/orders.order_status') }}</option>
                            <option value="{{ Order::ORDERED }}"> {{ trans('Admin/orders.ordered') }} </option>
                            <option value="{{ Order::DELIVERED }}"> {{ trans('Admin/orders.deliverd_process') }} </option>
                            <option value="{{ Order::UNDER_PROCESS }}"> {{ trans('Admin/orders.under_process') }} </option>
                            <option value="{{ Order::PUSH_FROM_STOCK }}"> {{ trans('Admin/orders.push_from_stock') }} </option>
                            <option value="{{ Order::FINISHED }}"> {{ trans('Admin/orders.finish') }} </option>
                            <option value="{{ Order::REJECTED }}"> {{ trans('Admin/orders.order_reject') }} </option>
                            <option value="{{ Order::CANCELED }}"> {{ trans('Admin/orders.canceled') }} </option>
                    </select>
                </div>
            </div>
            {{-- $selectedStatus --}}
            <div>
                @if ($checked)
                <div class="dropdown ml-4">
                    <button class="btn btn-primary btn-lg dropdown-toggle" data-toggle="dropdown"> {{__('Website/vendor/dashboard.check_no')}}
                        ({{ count($checked) }})</button>
                    <div class="dropdown-menu">
                        <a href="#" class="dropdown-item" type="button"
                            onclick="confirm('<?php echo __('Website/vendor/dashboard.export_confirm_msg');?>') || event.stopImmediatePropagation()"
                            wire:click="exportSelected()">
                            {{__('Website/vendor/dashboard.export')}}
                        </a>

                        <a href="#" class="dropdown-item" type="button"
                            onclick="confirm('<?php echo __('Website/vendor/dashboard.cancel_confirm_msg');?>') || event.stopImmediatePropagation()"
                            wire:click="cancelSelected()">
                            {{__('Website/vendor/dashboard.cancel')}}
                        </a>
                    </div>

                </div>
                @endif
            </div>
        </div>
        <!-- End d-flex -->
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
                    <th><!--<input type="checkbox" wire:model="selectPage" onclick="checkAll('box1',this)">--></th>
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
                        <td><input type="checkbox" class="box1" value="{{ $order->id }}" wire:model="checked" ></td>
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
                            <!-- End Print Btn -->
                            @if($order->status == Order::ORDERED)
                                <button class="btn btn-danger btn-sm" type="button"
                                onclick="confirm('<?php echo __('Website/vendor/dashboard.cancel_confirm_msg');?>') || event.stopImmediatePropagation()"
                                wire:click="cancelOrder('{{ $order->id }}')"
                                >
                                    <i class="fontello-cancel"> </i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="">
                        <td class="align-center mt-5">
                            <p class="text-danger">{{ trans('Website/vendor/dashboard.no_data_found') }}</p>
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
<script>
    function checkAll(name,elem){
        var checkboxes = document.getElementsByClassName(name);
        var leng = checkboxes.length;

        if(elem.checked){
            for(var i=0 ; i < leng ; i++){
                checkboxes[i].checked = true;
             }
        }else{
            for(var i=0 ; i < leng ; i++){
                checkboxes[i].checked = false;
             }
        }
    }
</script>
