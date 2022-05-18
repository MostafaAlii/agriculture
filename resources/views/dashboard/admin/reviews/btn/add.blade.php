<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/about.review_title') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('review.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin/about.name') }}" required/>
                        @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.email') }}</label>
                        <input type="email" name="email" class="form-control" placeholder="{{ trans('Admin/about.email') }}" required />
                        @error('email')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.message') }}</label>
                        <textarea name="message" class="form-control" placeholder="{{ trans('Admin/about.message') }}" required></textarea>
                        @error('message')
                            <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.status') }}</label>
                        <select name="show_or_hide" class="form-control"  required >
                            <option value="1"> {{ trans('Admin/about.show') }}</option>
                            <option value="0"> {{ trans('Admin/about.hide') }}</option>
                        </select>
                       
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