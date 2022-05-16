<div class="btn-group">
<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{ __('Admin/site.action') }}
    </button>
    <div class="dropdown-menu dropmenu-menu-right">
        <a href="{{ route('Roles.edit', encrypt($role->id)) }}" class="dropdown-item btn btn-outline-primary btn-md">
            {{ __('Admin/site.edit') }}
        </a>
        <a type="button" class="dropdown-item btn btn-outline-danger btn-md" data-toggle="modal" data-target="#delete{{ $role->id }}">
            {{ __('Admin/site.delete') }}
        </a>
        <div class="dropdown-divider"></div>
    </div>
</div>

{{-- modal delete --}}
<form action="{{ route('Roles.destroy', encrypt($role->id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('delete')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="delete{{ $role->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.delete') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin/site.warning') }}</h5>

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
{{-- End modal delete --}}

{{-- modal bulk delete --}}
<form action="{{-- route('roles.bulk_delete','ids') --}}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
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
