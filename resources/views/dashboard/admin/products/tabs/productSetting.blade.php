<div class="tab-pane fade" id="productSetting" role="tabpanel" aria-labelledby="productSetting-tab" aria-expanded="false">
    <h5 class="text-info mt-2">{{ trans('Admin/products.product_setting') }}</h5>
    <fieldset>
        <!-- Start Product Price & Units Row -->
        <div class="row">
            <!-- Start Unit Select -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.select class="form-control" name="units" :options="$units->pluck('Name', 'id')" :label=" __('Admin\products.product_units_select')" />
                </div>
            </div>
            <!-- End Unit Select -->

            <!-- Start Product Price -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.input class="form-control" type="number" name="price" :label=" __('Admin/products.product_main_price_placeholder')" />
                </div>
            </div>
            <!-- End Product Price -->
        </div>
        <!-- End Product Price & Units Row -->
        <!-- Start Stock Qty -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.input class="form-control" type="number" name="qty" :label=" __('Admin/products.product_stock_quantity')" />
                </div>
            </div>
        </div>
        <!-- End Stock Qty -->
        <hr>
        <!------------------------------------------------------------- Offers ------------------------------------------------->
        <h5 class="text-info mt-3">{{ trans('Admin/products.special_offers') }}</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.input type="date" class="form-control" name="special_price_start" :label=" __('Admin/products.product_start_date_offer')" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.input type="date" class="form-control" name="special_price_end" :label=" __('Admin/products.product_end_date_offer')" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <x-dashboard.inputs.input class="form-control" type="number" name="special_price" :label=" __('Admin/products.product_private_price')" />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('status',trans('Admin\products.product_status')) !!}
                    {!! Form::select('status',['pending'=>trans('Admin/products.pending'), 'reject'=>trans('Admin/products.reject'), 'active'=>trans('Admin/products.active')],$product->status,['class'=>'form-control status','placeholder'=>trans('Admin\products.product_status')]) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group reason  display:none"  id="reject_resoan">
                    {!! Form::label('reason',trans('Admin\products.reject_reason')) !!}
                    {!! Form::textarea('reason',$product->reason,['class'=>'form-control','placeholder'=>trans('Admin/products.type_reject_reason')]) !!}
                </div>
            </div>
        </div>

    </fieldset>
</div>
