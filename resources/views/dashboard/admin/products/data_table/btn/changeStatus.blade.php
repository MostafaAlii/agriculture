<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="text-left modal animated zoomInDown"  tabindex="-1" role="dialog" aria-hidden="true" id="changeStatus{{ $product->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">{{trans('Admin\products.product_change_status')}} / <span class="text-primary">{{ $product->name }}</span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{ route('products.changeStatus') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <label for="projectinput1">
                                            {{ trans('Admin\products.product_change_status') }}
                                        </label>
                                        <select name="status" id="manageStock" class="form-control" style="outline-style: none;" onchange="this.form.submit()">
                                            <optgroup label="{{ trans('Admin\products.product_tracking_stock_placeholder') }}">
                                                <option {{ $product->status == '1' ? "selected" : "" }} value="1">{{ __('Admin/products.active') }}</option>
                                                <option {{ $product->status == '0' ? "selected" : "" }} value="0">{{ __('Admin/products.not_active') }}</option>
                                            </optgroup>
                                        </select>
                                        <!-- End Product Status -->
                                        @error('status')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
