<div>
@can('unit-edit')
    <button type="button" class="btn btn-btn btn-info btn-sm " data-toggle="modal" data-target="#edit{{ $id }}" >
        <i class="fa fa-trash"></i>
        {{ __('Admin\units.edit') }}
    </button>
@endcan
</div>

<div class="col-lg-4 col-md-6 col-sm-12">
    <div class="form-group">
        <!-- Modal -->
        <div class="text-left modal animated flipInY"  tabindex="-1" role="dialog" aria-hidden="true" id="delete{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('Units.destroy', encrypt($id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\units.delete') }}</h4>
                            <input type="hidden" value="{{ $id }}" id="id">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>{{ __('Admin\trees.warning') }}</h5>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\units.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\units.delete') }}</button>
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
        <div class="text-left modal animated flipInY"  tabindex="-1" role="dialog" aria-hidden="true" id="edit{{ $id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                        <div class="modal-header" id="modal">
                            <h4 class="modal-title" id="myModalLabel62">   {{ __('Admin\trees.edit') }}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <form action="{{ route('Units.update', encrypt($id)) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                        @csrf
                        @method('patch')
                        <input type="hidden" value="{{ $id }}" name="id">

                        <div class="modal-body">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin\units.enter_unit_name') }}</label>
                                <input type="text" name="Name" class="form-control" required="required"
                                       placeholder="{{ trans('Admin\units.enter_unit_name_placeholder') }}"
                                       value="{{\App\Models\Unit::findorFail($id)->Name}}"/>
                            </div>

                            <div class="mt-1 form-group">
                                <input type="checkbox" value="1"
                                    name="visibility"
                                    id="switcheryColor4"
                                    class="js-switch" data-color="success"
                                    <?php if(\App\Models\Unit::findorFail($id)->visibility==1)echo 'checked';?>
                                    />
                                <label for="switcheryColor4" class="ml-1 card-title">
                                    <i class="material-icons text-dark">mode_edit</i>
                                    {{ trans('Admin/units.switch_between_product_or_general') }} :
                                    <span class="pull-left"></span>
                                </label>

                                @error("visibility")
                                <span class="text-danger">{{$message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin\units.close') }}</button>
                            <button type="submit" class="btn btn-outline-primary"> {{ __('Admin\units.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--end edit one raw--}}

{{-- modal bulk delete --}}
{{--<form action="{{ route('units.bulk_delete','ids') }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">--}}
    {{--@csrf--}}
    {{--@method('delete')--}}
    {{--<div class="col-lg-4 col-md-6 col-sm-12">--}}
        {{--<div class="form-group">--}}
            {{--<!-- Modal -->--}}
            {{--<div class="text-left modal animated flipInY" id="bulkdeleteall" tabindex="-1" role="dialog" aria-hidden="true">--}}
                {{--<div class="modal-dialog" role="document">--}}
                    {{--<div class="modal-content">--}}
                        {{--<div class="modal-header">--}}
                            {{--<h4 class="modal-title" id="myModalLabel62">   {{ __('Admin/site.bulkdelete') }}</h4>--}}
                            {{--<input type="hidden" id="delete_select_id" name="delete_select_id" value="">--}}
                            {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                {{--<span aria-hidden="true">&times;</span>--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<div class="modal-body">--}}
                            {{--<h5>{{ __('Admin/trees.warning') }}</h5>--}}
                        {{--</div>--}}
                        {{--<div class="modal-footer">--}}
                            {{--<button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal"> {{ __('Admin/units.cancel') }}</button>--}}
                            {{--<button type="submit" class="btn btn-outline-primary"> {{ __('Admin/units.delete') }}</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</form>--}}
{{--End modal bulk delete --}}
