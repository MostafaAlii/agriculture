<div class="modal fade" id="edit{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="material-icons">mode_edit</i>
                    {{ trans('Admin/proviences.proviencePageTitle_edit') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Start Form -->
            <form action="{{ route('Proviences.update', 'test') }}" method="post" autocomplete="off">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <!-- Start City Select -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput2">
                                    <i class="material-icons">flag</i>
                                    {{ trans('Admin/proviences.choose_country_name') }}
                                    <input type="hidden" name="id" class="form-control" value="{{ $id }}" />
                                </label>
                                <select name="country_id" class="select2 form-control">
                                    <optgroup label="{{ trans('Admin/proviences.please_choose_country_name') }}">
                                            
                                            {{--  @foreach($country as $coun)
                                                <option value="{{$id }}" {{$id == $country_id ? 'selected' : '' }}>
                                                    {{$coun->name}}
                                                </option>
                                            @endforeach--}}
                                        
                                    </optgroup>
                                </select>
                                @error('country_id')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- End City Select -->
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('dashboard/general.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('dashboard/general.cancel') }}</button>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
</div>