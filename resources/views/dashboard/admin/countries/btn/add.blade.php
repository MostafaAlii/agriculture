<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/countries.add_new_country') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Countries.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/countries.enter_country_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin/countries.enter_country_name_placeholder') }}" />
                    </div>
                    <div class="form-group">
                        <label>{{ trans('Admin/countries.country_flag') }}</label>


                            <a href="#" class="btn btn-sm btn-primary mr-25">
                                <input class="form-control img" name="image"  type="file" accept="image/*">
                            </a>


                            <a class="mr-2" href="#">
                                <img src="{{ asset('Dashboard/img/countries/avatar.jpg') }}"
                                     alt="{{ asset('Dashboard/img/countries/avatar.jpg') }}"
                                     class="users-avatar-shadow rounded-circle img-preview" height="64" width="64">
                            </a>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/countries.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/countries.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>