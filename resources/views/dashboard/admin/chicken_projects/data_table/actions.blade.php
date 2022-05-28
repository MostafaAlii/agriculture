@can('chicken-project-edit')
    <a href="{{ route('Chickens.edit', encrypt($id)) }}" class="btn btn-info btn-sm">
        <i class="fa fa-edit"></i>
        {{ __('Admin/animals.edit') }}
    </a>
@endcan
@can('chicken-project-delete')
    <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $id }}" >
        <i class="fa fa-trash"></i>
        {{ __('Admin/animals.delete') }}
    </button>
@endcan



        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $id }}">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form action="{{ route('Chickens.destroy', encrypt($id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-header" id="modal">
                                        <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/animals.delete') }}</h4>
                                        <input type="hidden" value="{{ $id }}" id="id">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>{{ __('Admin/site.warning') }}</h5>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/animals.close') }}</button>
                                        <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/animals.delete') }}</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      {{-- modal bulk delete --}}
    <form action="{{ route('chicken.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="bulkdelete" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/areas.cancel') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/areas.delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>      {{--End modal bulk delete --}}
