<!-- start Recent 5 products -->
@if(isset($orders))
<!-- Start Table Responsive -->
<div class="table-responsive">
    <center><h3>{{ trans('Admin/orders.orderPageTitle') }}</h3></center>
  <!-- Start Table -->
  <table class="table table-striped table-bordered zero-configuration" id="countries-table" style="background-color: #FFFFFF;">
      <thead>
          <tr style="background-color: #c2f7bf;">
              <th>{{ __('Admin/orders.order_referance') }}</th>
              <th>{{ __('Admin/orders.order_vendor_name') }}</th>
              <th>{{ __('Admin/orders.order_total') }}</th>
              <th>{{ __('Admin/orders.order_item_num') }}</th>
          </tr>
          @foreach($orders as $order)
          <tr>
              <td><a href="{{ route('order.show', encrypt($order->id)) }}">{{$order->referance_id}}</a></td>
              <td>{{$order->firstname .' '. $order->lastname}}</td>
              <td>{{$order->total}}</td>
              <td><a href="{{ route('order.show', encrypt($order->id)) }}">{{count($order->orderItems)}}</a></td>
          </tr>
          @endforeach
      </thead>
  </table>
  <!-- End Table -->
</div>
<!-- End Table Responsive -->
@endif
<!-- end Recent 5 products -->