@can('product-processes')
    <div class="btn-group">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ __('Admin/site.action') }}
        </button>
        <div class="dropdown-menu dropmenu-menu-right">
            @can('product-edit')
                <a href="{{ route('product_edit',encrypt($product->id)) }}" class="dropdown-item btn btn-outline-primary btn-md">
                    {{ __('Admin/site.edit') }}
                </a>
            @endcan
            @can('product-special-price')
                <button type="button" class="dropdown-item btn btn-outline-warning btn-md " data-toggle="modal" data-target="#price{{ $product->id }}" >
                    {{ __('Admin/products.prices_managment') }}
                </button>
            @endcan
            @can('product-change-status')
                <button type="button" class="dropdown-item btn btn-outline-primary btn-md " data-toggle="modal" data-target="#changeStatus{{ $product->id }}" >
                    {{ __('Admin/products.product_change_status') }}
                </button>
            @endcan
            @can('product-stock')
                <button type="button" class="dropdown-item btn btn-outline-success btn-md " data-toggle="modal" data-target="#stock{{ $product->id }}" >
                    {{ __('Admin/products.stock') }}
                </button>
            @endcan
            @can('product-delete')
                <a type="button" class="dropdown-item btn btn-outline-danger btn-md" data-toggle="modal" data-target="#delete{{ $product->id }}">
                    {{ __('Admin/site.delete') }}
                </a>
            @endcan
            <div class="dropdown-divider"></div>
        </div>
    </div>

@endcan
<!-- Start Product Stock Model -->
@include('dashboard.admin.products.data_table.btn.stock')
<!-- End Product Stock Model -->

<!-- Start Product changeStatus Model -->
@include('dashboard.admin.products.data_table.btn.changeStatus')
<!-- End Product changeStatus Model -->

<!-- Start Product Stock Model -->
@include('dashboard.admin.products.data_table.btn.offer_price')
<!-- End Product Stock Model -->

{{-- modal delete --}}
<form action="{{ route('product_delete',encrypt($product->id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('delete')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="text-left modal animated flipInY" id="delete{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.delete') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin/site.warning') }}</h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{-- End modal delete --}}

{{-- modal bulk delete --}}
<form action="{{ route('products.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('delete')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="text-left modal animated flipInY" id="bulkdeleteall" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.bulkdelete') }}</h4>
                            <input type="hidden" id="delete_select_id" name="delete_select_id" value="">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin/site.warning') }}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{--End modal bulk delete --}}
