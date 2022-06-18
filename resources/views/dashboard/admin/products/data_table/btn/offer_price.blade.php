<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="text-left modal animated zoomInDown"  tabindex="-1" role="dialog" aria-hidden="true" id="price{{ $product->id }}">
            <div class="modal-dialog model-lg" role="document">
                <div class="modal-content">

                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">{{ __('Admin/products.specialPricePageTitle') }} / {{ $product->name }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{ route('products.prices.store') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf
                        @method('post')
                        <div class="modal-body">
                            <!-- Start Tags Multi Select -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                                        <label for="projectinput1">
                                            {{ trans('Admin\products.product_price_select') }}
                                        </label>
                                        <select name="special_price_type" class="select2 form-control">
                                            <optgroup label="{{ trans('Admin\products.product_price_select_placeholder') }}">
                                                <option {{ $product->special_price_type == 'precent' ? "selected" : "" }} value="precent">{{ __('Admin/products.precent') }}</option>
                                                <option {{ $product->special_price_type == 'fixed' ? "selected" : "" }} value="fixed">{{ __('Admin/products.fixed') }}</option>
                                            </optgroup>
                                        </select>
                                        @error('special_price_type')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1">
                                            {{ trans('Admin\products.product_private_price') }}
                                        </label>
                                        <input type="number" name="special_price" value="{{ $product->special_price }}" class="form-control" placeholder="{{ trans('Admin/products.product_private_price') }}" />
                                        @error('special_price')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End Tags Multi Select -->

                            <!-- Start Dates -->
                            <div class="row" >
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1">{{ trans('Admin\products.product_start_date_offer') }}</label>
                                        <input type="date" id="start_date" name="special_price_start" class="form-control form-control-md form-control-solid" placeholder="{{ trans('Admin\products.product_start_date_offer') }}" value="{{old('special_price_start')}}"  />

                                        @error('special_price_start')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="projectinput1">{{ trans('Admin\products.product_end_date_offer') }}</label>
                                        <input type="date" id="end_date" name="special_price_end" class="form-control form-control-md form-control-solid" placeholder="{{ trans('Admin\products.product_end_date_offer') }}" value="{{$product->special_price_end }}"  />
                                        @error('special_price_end')
                                        <span class="text-danger"> {{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- End Dates -->




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\units.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\general.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
