<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/villages.add_new_village') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('Villages.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/villages.enter_village_name') }}</label>
                        <input type="text" name="name" class="form-control" required="required" placeholder="{{ trans('Admin/villages.enter_village_name_placeholder') }}" />
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="projectinput2">
                                <i class="material-icons">flag</i>
                                {{ trans('Admin/villages.choose_state_name') }}
                            </label>
                            <select name="state_id" class="select2 form-control" required="required">
                                <optgroup label="{{ trans('Admin/villages.please_state_country_name') }}">
                                    @if($states && $states -> count() > 0)
                                        @foreach($states as $state)
                                            <option value="{{$state->id }}">
                                                {{$state->name}}
                                            </option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('state_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
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