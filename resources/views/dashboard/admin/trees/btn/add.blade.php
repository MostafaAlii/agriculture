<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin\trees.add_new_tree') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('Trees.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin\trees.enter_tree_name') }}</label>
                        <input type="text" name="name" class="form-control" placeholder="{{ trans('Admin\trees.enter_tree_name_placeholder') }}" />
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror

                    </div>
                    <label for="projectinput2">
                        <i class="material-icons"></i>
                        {{ trans('Admin\trees.choose_tree_type_name') }}
                    </label>
                    <select name="tree_type_id" class="select2 form-control">
                        <optgroup label="{{ trans('Admin\trees.please_choose_tree_type') }}">
                            @if($tree_types && $tree_types -> count() > 0)
                                @foreach($tree_types as $tree_type)
                                    <option value="{{$tree_type->id }}">
                                        {{$tree_type->tree_type}}
                                    </option>
                                @endforeach
                            @endif
                        </optgroup>
                    </select>
                    @error('tree_type_id')
                    <span class="text-danger"> {{$message}}</span>
                    @enderror


                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Admin\trees.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Admin\trees.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>