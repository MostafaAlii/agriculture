<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/crops.add_new_crop') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Crops.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/crops.enter_crop_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin/crops.enter_crop_name_placeholder') }}" />
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/crops.enter_crop_type') }}</label>
                        <select name="type" class="select2 form-control">
                            <option label="{{ trans('Admin\crops.please_choose_crop_type') }}">

                                <option value="summer">
                                    {{__('Admin\crops.summer')}}
                                </option>
                                <option value="winter">
                                    {{__('Admin\crops.winter')}}
                                </option>

                            </option>
                        </select>
                        @error('crop_type')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror


                    </div>


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/lands.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/lands.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>