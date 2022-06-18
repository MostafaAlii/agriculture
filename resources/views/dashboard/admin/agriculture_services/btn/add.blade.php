<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/services.add_new_agriculture_service') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('AgricultureServices.store') }}" method="post" autocomplete="off" >
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/services.enter_service_name') }}</label>
                        <input type="text" name="name" class="form-control"
                               placeholder="{{ trans('Admin/services.enter_service_name_placeholder') }}" required="required"/>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/services.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/services.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>