<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="text-left modal animated zoomInDown"  tabindex="-1" role="dialog" aria-hidden="true" id="stock{{ $product->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">{{trans('Admin\products.stock_managment')}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{ route('products.stock.store') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <label for="projectinput1">
                                            {{ trans('Admin\products.product_tracking_stock') }}
                                        </label>
                                        <select name="stock" class="form-control">
                                            <optgroup label="{{ trans('Admin\products.product_tracking_stock_placeholder') }}">
                                                <option {{ $product->stock == '1' ? "selected" : "" }} value="1">{{ __('Admin/products.allow_tracking') }}</option>
                                                <option {{ $product->stock == '0' ? "selected" : "" }} value="0">{{ __('Admin/products.no_tracking') }}</option>
                                            </optgroup>
                                        </select>
                                        @error('stock')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1">{{ trans('Admin/products.product_stock_quantity') }}</label>
                                        <input type="number" class="form-control" placeholder="{{ trans('Admin/products.product_stock_quantity_placeholder') }}" value="{{ $product->qty }}" name="qty">
                                        @error("qty")
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\units.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\units.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
