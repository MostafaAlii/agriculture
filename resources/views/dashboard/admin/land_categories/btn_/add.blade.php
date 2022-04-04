<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/lands.add_new_land_category') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('LandCategories.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/lands.enter_category_name') }}</label>
                        <input type="text" name="category_name" class="form-control" placeholder="{{ trans('Admin/lands.enter_category_name_placeholder') }}" />
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                    </div>
                    <label for="projectinput2"><i class="material-icons">mode_edit</i>
                        {{__('Admin\lands.choose_category_type')}}
                    </label>
                    <select name="category_type" class="select2 form-control">
                        <optgroup >
                            <option value="" disabled selected>{{__('Admin\lands.choose_category_type')}}</option>
                            <option value="0">{{__('Admin\lands.agricultural')}}</option>
                            <option value="1">{{__('Admin\lands.non_agricultural')}}</option>


                        </optgroup>
                    </select>
                    @error('category_type')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/lands.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/lands.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>