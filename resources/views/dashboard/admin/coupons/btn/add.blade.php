<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/coupons.add_new_coupon') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('ProductCoupons.store') }}" method="post" autocomplete="off">
                @csrf
                <!-- Start Modal-Body -->
                <div class="modal-body">
                    <!-- Start First Row -->
                    <div class="row">
                        <!-- Start Code -->
                        <div class="col-3">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/coupons.enter_coupon_code') }}</label>
                                <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control" placeholder="{{ trans('Admin/coupons.enter_coupon_code_placeholder') }}" autocomplete="off" />
                                @error('code')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Code -->
                        <!-- Start Type Select -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="projectinput2">
                                    <i class="material-icons">loyalty</i>
                                    {{ trans('Admin/coupons.choose_type') }}
                                </label>
                                <select name="type" class="select2 form-control">
                                    <optgroup label="{{ trans('Admin/coupons.choose_type_placeholder') }}">
                                        <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : null }}>{{ trans('Admin/coupons.fixed') }}</option>
                                        <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : null }}>{{ trans('Admin/coupons.percentage') }}</option>
                                    </optgroup>
                                </select>
                                @error('type')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>    
                        </div>    
                        <!-- End Type Select -->
                        <!-- Start Value -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="value"><i class="material-icons">attach_money</i> {{ trans('Admin/coupons.value') }}</label>
                                <input type="text" name="value" value="{{ old('value') }}" class="form-control" placeholder="{{ trans('Admin/coupons.enter_value_placeholder') }}" autocomplete="off">
                                @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Value -->
                        <!-- Start Use Time -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="use_times"><i class="material-icons">format_list_numbered</i> {{ trans('Admin/coupons.use_time') }}</label>
                                <input type="number" name="use_times" value="{{ old('use_times') }}" class="form-control"  placeholder="{{ trans('Admin/coupons.enter_useTime_placeholder') }}" autocomplete="off">
                                @error('use_times')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Use Time -->
                        
                    </div>
                    <!-- End First Row -->
                    
                    <!-- Start Second Row -->
                    <div class="row">
                        <!-- Start Start Date -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="start_date"><i class="material-icons">date_range</i> {{ trans('Admin/coupons.start_date') }}</label>
                                <input type="text" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control" autocomplete="off">
                                @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Start Date -->
                        <!-- Start Expired Date -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="expire_date"><i class="material-icons">date_range</i> {{ trans('Admin/coupons.expire_date') }}</label>
                                <input type="text" name="expire_date" id="expire_date" value="{{ old('expire_date') }}" class="form-control" autocomplete="off">
                                @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Expired Date -->
                        <!-- Start Greater Than -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="greater_than"><i class="material-icons">grade</i> {{ trans('Admin/coupons.greater_than') }}</label>
                                <input type="number" name="greater_than" value="{{ old('greater_than') }}" class="form-control" autocomplete="off">
                                @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Greater Than -->
                    </div>
                    <!-- End Second Row -->

                    <!-- Start Thired Row -->
                    <div class="row">
                        <!-- Start Farmer Selected -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="projectinput2">
                                    <i class="material-icons">perm_identity</i>
                                    {{ trans('Admin/coupons.choose_username') }}
                                </label>
                                <select name="user_id" class="select2 form-control">
                                    <optgroup label="{{ trans('Admin/coupons.choose_username_placeholder') }}">
                                        @if($users && $users->count() > 0)
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">
                                                    {{$user->firstname . ' ' . $user->lastname}}
                                                </option>
                                            @endforeach
                                        @endif
                                    </optgroup>
                                </select>
                                @error('user_id')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Farmer Selected -->
                        <!-- Start Status Select -->
                        <div class="col-4">
                            <div class="form-group">
                                <label for="projectinput2">
                                    <i class="material-icons">done</i>
                                    {{ trans('Admin/coupons.choose_status') }}
                                </label>
                                <select name="status" class="select2 form-control">
                                    <optgroup label="{{ trans('Admin/coupons.choose_type_placeholder') }}">
                                        <option value="1" {{ old('status') == '1' ? 'selected' : null }}>{{ trans('Admin/coupons.active') }}</option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : null }}>{{ trans('Admin/coupons.not_active') }}</option>
                                    </optgroup>
                                </select>
                                @error('status')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Status Select -->
                    </div>
                    <!-- End Thired Row -->

                    <!-- Start Fourth Row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description"><i class="material-icons">mode_edit</i> {{ trans('Admin/coupons.description') }}</label>
                                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <!-- End Fourth Row -->

                    

                    
                </div>
                <!-- End Modal-Body -->

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/general.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/general.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>