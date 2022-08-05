<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/whole_sale_products.add_new_product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('WholeSaleProducts.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/whole_sale_products.enter_whole_sale_product_name') }}</label>
                        <input type="text" name="name" class="form-control" required="required"
                               placeholder="{{ trans('Admin/whole_sale_products.enter_whole_sale_product_name_placeholder') }}" />
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                    </div>



                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/whole_sale_products.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/whole_sale_products.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>