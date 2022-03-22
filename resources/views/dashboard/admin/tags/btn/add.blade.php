<!-- Modal -->
<div class="modal fade" id="addtag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i>{{ __('Admin/site.newtag') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('tags.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{-- <form  action="javascript:void(0)" id="tagForm" name="tagForm" method="POST" autocomplete="off"> --}}
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ __('Admin/site.addtag') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ __('Admin/site.name') }}" required  />
                        @error('name')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <input type="hidden" name="status" value="0">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/countries.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/countries.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
