<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/options.options_name') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('Options.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/options.options_add_opt_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin/options.options_add_opt_name') }}" />
                        @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>{{ __('Admin/options.attribute') }}</label>
                        <select class="form-control" name="attribute_id" readonly>
                                @foreach($attributes as $attr)
                                    <option value="{{$attr->id}}" <?php if(old('attribute_id')==$real_id){echo "selected";}?>>{{$attr->name}}</option>
                                @endforeach
                            </select>
                        @error('attribute_id')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>{{ __('Admin/options.type') }}</label>
                        <select class="form-control" name="type" onchange="javascript:handel_type(this.value);">
                            <option value="1"  <?php if(old('type')==1){echo "selected";}?>>{{ __('Admin/options.depart') }}</option>
                            <option value="2"  <?php if(old('type')==2){echo "selected";}?>>{{ __('Admin/options.product') }}</option>
                        </select>
                        @error('type')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group" id="depart_div">
                        <label>{{ __('Admin/options.all_depart') }}</label>
                        <select class="form-control" name="depart_id" id="depart_id">
                                @foreach($departments as $depart)
                                    <option value="{{$depart->id}}"  <?php if(old('depart_id')==$depart->id){echo "selected";}?>>{{$depart->name}}</option>
                                @endforeach
                            </select>
                        @error('depart_id')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group" id="product_div" style="display:none">
                        <label>{{ __('Admin/options.all_product') }}</label>
                        <select class="form-control" name="product_id" id="product_id">
                                @foreach($products as $pro)
                                    <option value="{{$pro->id}}"  <?php if(old('product_id')==$pro->id){echo "selected";}?>>{{$pro->name}}</option>
                                @endforeach
                            </select>
                        @error('product_id')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/general.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/general.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>