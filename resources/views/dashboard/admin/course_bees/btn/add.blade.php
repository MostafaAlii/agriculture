<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/bees.add_new_course') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('CourseBees.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/bees.enter_course_name') }}</label>
                        <input type="text" name="name" class="form-control"  required="required"  placeholder="{{ trans('Admin/bees.enter_course_name_placeholder') }}" />
                    </div>
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/bees.enter_course_desc') }}</label>
                        <textarea type="text" name="desc" class="form-control" rows="3" placeholder="{{ trans('Admin/bees.enter_course_desc_placeholder') }}"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/bees.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/bees.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>