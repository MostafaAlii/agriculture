<div>
    @can('tree-type-edit')
        <button type="button" class="btn btn-btn btn-info btn-sm " data-toggle="modal" data-target="#edit{{ $id }}" >
            <i class="fa fa-trash"></i>
            {{ __('Admin\trees.edit') }}
        </button>
    @endcan
    @can('tree-type-delete')
        <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $id }}" >
            <i class="fa fa-trash"></i>
            {{ __('Admin\trees.delete') }}
        </button>
    @endcan
</div>

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="modal animated flipInY text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('TreeTypes.destroy', encrypt($id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\trees.delete') }}</h4>
                            <input type="hidden" value="{{ $id }}" id="id">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin\trees.warning') }}</h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\trees.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\trees.delete') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{--end delete one raw--}}

{{--edit one raw--}}




<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="modal animated flipInY text-left"  tabindex="-1" role="dialog" aria-hidden="true" id="edit{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\trees.edit') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{ route('TreeTypes.update', encrypt($id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="{{ $id }}" name="id" required="required">

                        <div class="modal-body">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin\trees.enter_tree_type') }}</label>
                                <input type="text" name="tree_type" class="form-control"

                                       placeholder="{{ trans('Admin\trees.enter_tree_type_placeholder') }}"
                                       value="{{\App\Models\TreeType::findorFail($id)->tree_type}}"/>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\trees.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\trees.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--end edit one raw--}}

{{-- modal bulk delete --}}
<form action="{{ route('treeTypes.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
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
                            <h5>{{ __('Admin/trees.warning') }}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/trees.cancel') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/trees.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{--End modal bulk delete --}}
