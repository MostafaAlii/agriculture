
<div>
    @can('land-categories-edit')
        <button type="button" class="btn btn-btn btn-info btn-sm " data-toggle="modal" data-target="#edit{{ $id }}">
            <i class="fa fa-edit">{{__('Admin\lands.edit')}}</i>
        </button>
    @endcan
    @can('land-categories-delete')
        <button type="button" class="btn btn-btn btn-danger btn-sm " data-toggle="modal" data-target="#delete{{ $id }}">
            <i class="fa fa-trash">{{__('Admin\lands.delete')}}</i>
        </button>
    @endcan
</div>


<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="modal animated flipInY text-left" tabindex="-1" role="dialog" aria-hidden="true"
             id="delete{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('LandCategories.destroy', encrypt($id)) }}" class="my-1 my-xl-0"
                          method="post" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\lands.delete') }}</h4>
                            <input type="hidden" value="{{ $id }}" id="id">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin\lands.warning') }}</h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary"
                                    data-dismiss="modal"> {{ __('Admin\lands.close') }}</button>
                            <button type="submit"
                                    class="btn btn-outline-primary"> {{ __('Admin\lands.delete') }}</button>
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
        <div class="modal animated flipInY text-left" tabindex="-1" role="dialog" aria-hidden="true" id="edit{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header" id="modal">
                        <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\lands.edit') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('LandCategories.update', encrypt($id)) }}" class="my-1 my-xl-0" method="post"
                          style="display: inline-block;">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="{{ $id }}" name="id">

                        @php
                            $land_category = \App\Models\LandCategory::findorfail($id)->first();
                        @endphp

                        <div class="modal-body">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin\lands.enter_category_name') }}
                                </label>
                                <input type="text" name="category_name" class="form-control"
                                       value="{{$land_category->category_name}}"
                                       placeholder="{{ trans('Admin/lands.enter_category_name_placeholder') }}"/>
                                @error('name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror

                            </div>


                            <div class="form-group">


                                <label for="projectinput2"><i class="material-icons">mode_edit</i>
                                    {{__('Admin\lands.choose_category_type')}}
                                </label>
                                <select name="category_type" class="select2 form-control">
                                    <optgroup >

                                        <option value="agriculture"{{($land_category->category_type == 'agriculture') ? 'selected' : '' }} >{{__('Admin\lands.agricultural')}}</option>
                                        <option value="non_agriculture" {{ ($land_category->category_type == 'non_agriculture'? 'selected' : '')}}>{{__('Admin\lands.non_agricultural')}}</option>

                                    </optgroup>
                                </select>
                                @error('category_type')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror


                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary"
                                    data-dismiss="modal"> {{ __('Admin\lands.close') }}</button>
                            <button type="submit"
                                    class="btn btn-outline-primary"> {{ __('Admin\lands.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--end edit one raw--}}

{{-- modal bulk delete --}}
<form action="{{ route('landCategories.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
    @csrf
    @method('delete')
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="form-group">
            <!-- Modal -->
            <div class="modal animated flipInY text-left" id="bulkdelete" tabindex="-1" role="dialog"
                 aria-hidden="true">
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
                            <h5>{{ __('Admin/lands.warning') }}</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary"
                                    data-dismiss="modal"> {{ __('Admin/lands.cancel') }}</button>
                            <button type="submit"
                                    class="btn btn-outline-primary"> {{ __('Admin/lands.delete') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
{{--End modal bulk delete --}}
