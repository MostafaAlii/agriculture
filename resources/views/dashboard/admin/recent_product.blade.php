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
                  
                  <img class="mr-2 users-avatar-shadow rounded-circle img-preview" height="64" width="64" src=" {{ $product->image_path ?
                  $product->image_path : URL::asset('Dashboard/img/Default/default_product.jpg') }}"
                  alt="{{ $product->name }}">
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