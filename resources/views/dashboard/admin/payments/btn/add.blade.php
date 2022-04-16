<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><i class="material-icons">add_circle_outline</i> {{ trans('Admin/payments.add_payment_details') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
            <form action="{{ route('Payments.store') }}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <!-- Start First Row -->
                    <div class="row">
                        <!-- Start Name -->
                        <div class="col-3">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/payments.enter_payment_name') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" placeholder="{{ trans('Admin/payments.enter_payment_name_placeholder') }}" autocomplete="off" />
                                @error('name')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Name -->
                        <!-- Start Code -->
                        <div class="col-3">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/payments.enter_payment_code') }}</label>
                                <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control" placeholder="{{ trans('Admin/payments.enter_payment_code_placeholder') }}" autocomplete="off" />
                                @error('code')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End Code -->
                        <!-- Start Sandbox -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="sandbox">{{ trans('Admin/payments.sandbox') }}</label>
                                <select name="sandbox" class="form-control">
                                    <option value="1" {{ old('sandbox') == '1' ? 'selected' : null }}>{{ trans('Admin/payments.sandbox') }}</option>
                                    <option value="0" {{ old('sandbox') == '0' ? 'selected' : null }}>{{ trans('Admin/payments.live') }}</option>
                                </select>
                                @error('sandbox')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Sandbox -->
                        <!-- Start Status -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">{{ trans('Admin/payments.status') }}</label>
                                <select name="status" class="form-control">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : null }}>{{ trans('Admin/payments.active') }}</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : null }}>{{ trans('Admin/payments.notActive') }}</option>
                                </select>
                                @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- End Status -->
                    </div>
                    <!-- End First Row -->

                    <!-- Start Second Row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="merchant_email">{{ trans('Admin/payments.merchant_email') }}</label>
                                <input type="email" name="merchant_email" value="{{ old('merchant_email') }}" class="form-control">
                                @error('merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <!-- Start DriverName -->
                        <div class="col-3">
                            <div class="form-group">
                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/payments.driver_name') }}</label>
                                <input type="text" id="driver_name" name="driver_name" value="{{ old('driver_name') }}" class="form-control" placeholder="{{ trans('Admin/payments.driver_name') }}" autocomplete="off" />
                                @error('driver_name')
                                    <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- End driver_name -->
                    </div>
                    <!-- End Second Row -->
                    <!-- Start Client ID -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_id">Client ID</label>
                                <input type="text" name="sandbox_client_id" value="{{ old('client_id') }}" class="form-control">
                                @error('client_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="client_secret">Client secret</label>
                                <input type="text" name="sandbox_client_secret" value="{{ old('client_secret') }}" class="form-control">
                                @error('client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <!-- End Client ID -->  
                    <!-- Start Sandbox Merchant Email -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sandbox_merchant_email">{{ trans('Admin/payments.sandbox_merchant_email') }}</label>
                                <input type="text" name="sandbox_merchant_email" value="{{ old('sandbox_merchant_email') }}" class="form-control">
                                @error('sandbox_merchant_email')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <!-- End Sandbox Merchant Email --> 
                    <!-- Start Sandbox client id --> 
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sandbox_client_id">Sandbox client id</label>
                                <input type="text" name="sandbox_client_id" value="{{ old('sandbox_client_id') }}" class="form-control">
                                @error('sandbox_client_id')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sandbox_client_secret">Sandbox client secret</label>
                                <input type="text" name="sandbox_client_secret" value="{{ old('sandbox_client_secret') }}" class="form-control">
                                @error('sandbox_client_secret')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div> 
                    <!-- End Sandbox client id --> 
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('Admin/general.save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Admin/general.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>