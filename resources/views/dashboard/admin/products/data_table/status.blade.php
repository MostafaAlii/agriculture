
<h4 class="{{$product->status =='1' ? 'badge border-success success badge-border': 'badge border-danger danger badge-border' }}">
    {{$product->status =='1' ?  __('Admin/products.active') : __('Admin/products.unactive')}}
</h4>
