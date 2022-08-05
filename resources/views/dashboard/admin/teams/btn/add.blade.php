<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/team.team_title') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('team.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/team.name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin/team.name') }}" required/>
                        @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/team.position') }}</label>
                        <input type="text" name="position" class="form-control" placeholder="{{ trans('Admin/team.position') }}" required />
                        @error('position')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/team.desc') }}</label>
                        <textarea type="text" id="description" class="form-control"
                                placeholder="{{trans('Admin\team.desc')}}"
                                    name="description">
                            {!! old('description') !!}
                        </textarea>
                        @error('description')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        
                        <label>{{trans('Admin\team.image')}} </label>

                            <input type="file" accept="image/*" name="image"  onchange="readURL(this);">
                            <img src=""  id="previewImg" class="img-thumbnail img-preview" width="100px" height="100px" alt="image" id="output">
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