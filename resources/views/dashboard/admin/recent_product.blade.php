<!-- start product 5 products -->
@if(count($latest_products)>0)
<!-- Start Table Responsive -->
<div class="table-responsive">
    <center><h3>{{__('Admin/site.newproducts')}}</h3></center>
  <!-- Start Table -->
  <table class="table table-striped table-bordered zero-configuration" id="countries-table" style="background-color: #FFFFFF;">
      <thead>
          <tr style="background-color: #c2f7bf;">
              <th>{{ __('Admin/products.product_main_image') }}</th>
              <th>{{ __('Admin/products.product_name') }}</th>
              <th>{{ __('Admin/products.product_price') }}</th>
              <th>{{ __('Admin/products.product_stock_quantity') }}</th>
          </tr>
          @foreach($latest_products as $product)
          <tr>
              <td>
                  @if(isset($product->image->filename))
                  <img src="{{ asset('Dashboard/img/products/'. $product->image->filename) }}" style="width: 100px;" alt="">
                  @else
                  <img src="{{ asset('Dashboard/img/images/products/default.jpg') }}" style="width: 100px;" alt="">
                  @endif
              </td>
              <td><a href="{{ route('product_details', encrypt($product->id)) }}">{{$product->name}}</a></td>
              <td>
                <?php $remove_unit=1;?>
                @includeWhen($product,'dashboard.admin.products.data_table.price_formated')
              </td>
            <td>{{$product->qty .'('.$product->GetUnit()->Name.')'}}</td>

          </tr>
          @endforeach
      </thead>
  </table>
  <!-- End Table -->
</div>
<!-- End Table Responsive -->
@endif
<!-- end product 5 products -->