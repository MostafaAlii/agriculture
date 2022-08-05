@can('tag-edit')
    <button type="button" class="btn btn-btn btn-info btn-sm " data-toggle="modal" data-target="#edit{{ $tag->id }}">
        <i class="fa fa-edit"></i>
        {{ __('Admin/site.edit') }}
    </button>
@endcan
@can('tag-delete')
    <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $tag->id }}">
        <i class="fa fa-trash"></i>
        {{ __('Admin/site.delete') }}
    </button>
@endcan

    <form action="{{ route('tags.destroy', encrypt($tag->id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="delete{{ $tag->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.delete') }}</h4>
                                <input type="hidden" value="{{ $tag->id }}" id="id">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>{{ __('Admin/site.warning') }}</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

      {{-- modal bulk delete --}}
      <form action="{{ route('tags.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="bulkdeleteall" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.bulkdelete') }}</h4>
                                <input type="hidden" id="delete_select_id" name="delete_select_id" value="">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5>{{ __('Admin/site.warning') }}</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
      {{--End modal bulk delete --}}
{{-- update modal --}}
<form action="{{ route('tags.update', encrypt($tag->id)) }}" method="post" autocomplete="off" >
    @csrf
    @method('PUT')
    <div class="modal fade" id="edit{{ $tag->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i>{{ __('Admin/site.newtag') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label><i class="material-icons">mode_edit</i> {{ __('Admin/site.updatetag') }}</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Admin/site.name') }}"
                            required value="{{ $tag->name }}" />
                            @error('name')
                            <small class="form-text text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>{{ __('Admin/site.status') }}</label>
                            <select class="custom-select" id="customSelect" name="status" value="{{ $tag->status }}">
                                <option value="{{ $tag->status }}" disabled selected >{{$tag->status == 1 ?  __('Admin/site.active') : __('Admin/site.unactive')}}</option>
                                <option value="1">{{ __('Admin/site.active') }}</option>
                                <option value="0">{{ __('Admin/site.unactive') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('Admin/countries.save') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/countries.cancel') }}</button>
                    </div>
            </div>
        </div>
    </div>
</form>
{{-- End update modal --}}

