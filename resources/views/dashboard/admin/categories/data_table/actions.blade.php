@can('category-edit')
<a href="{{ route('Categories.edit',encrypt($categories->id)) }}" class="btn btn-success btn-sm">
    <i class="fa fa-edit"></i>
    {{ __('Admin/site.edit') }}
</a>
@endcan
@can('category-delete')
<button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#flipInY{{$categories->id}}">
    <i class="fa fa-trash"></i>
    {{ __('Admin/site.delete') }}
</button>
@endcan
<form action="{{ route('Categories.destroy', encrypt($categories->id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('delete')
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="form-group">
                <!-- Modal -->
                <div class="modal animated flipInY text-left" id="flipInY{{$categories->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.delete') }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            {{$categories->related()}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                                <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

    {{-- modal bulk delete --}}
<form action="{{ route('categories.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
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
                                <center><h4>{{__('Admin/categories.confirm_deletion_all')}}</h4></center>
                                 <center><h3 style="color:red">{{__('Admin/categories.confirm_deletion_all2')}}</h3></center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/site.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin/site.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    {{--End modal bulk delete --}}
