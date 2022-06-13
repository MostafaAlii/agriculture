<div role="tabpanel" class="tab-pane active" id="generalInformation" aria-labelledby="generalInformation-tab" aria-expanded="true">
    <h5 class="text-info mt-2">{{ trans('Admin/products.general_product_information') }}</h5>
    <fieldset>
        <!-- Start Product Name & Farmer Select -->
        <div class="row">
            <!-- Start Product Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.input class="form-control" name="name" :label=" __('Admin/products.product_name')" />
                </div>
            </div>
            <!-- End Product Name -->
            <!-- Start Farmer Select -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.select class="select2 form-control" name="farmer_id" :options="$farmers->pluck('firstname', 'id')" :label=" __('Admin\products.product_farmer_select')" />
                </div>
            </div>
            <!-- End Farmer Select -->
        </div>
        <!-- End Product Name & Farmer Select -->

        <!-- Start Category & Tags Select -->
        <div class="row">
            <!-- Start Category Select -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.select class="select2 form-control" multiple name="categories" :options="$categories->pluck('name', 'id')" :label=" __('Admin\products.product_category_select')" />
                </div>
            </div>
            <!-- End Category Select -->
            <!-- Start Tags Select -->
            <div class="col-md-6">
                <div class="form-group">
                    <x-dashboard.inputs.select class="select2 form-control" multiple name="tags" :options="$tags->pluck('name', 'id')" :label=" __('Admin\products.product_tags_select')" />
                </div>
            </div>
            <!-- End Tags Select -->
        </div>
        <br>
        <!-- End Category & Tags Select -->
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('description',trans('Admin\products.product_description')) !!}
                    {!! Form::textarea('description',$product->description,['class'=>'form-control','placeholder'=>trans('Admin\products.product_description_placeholder')]) !!}
                </div>
            </div>
        </div>
    </fieldset>
</div>
