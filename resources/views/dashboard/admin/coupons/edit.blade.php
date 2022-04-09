@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>
    .picker__select--month, .picker__select--year {
        padding: 0 !important;
    }
</style>
@endsection
@section('pageTitle')
    {{ trans('Admin/coupons.coupon_title_in_sidebar') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">fiber_new</i>
                    {{ trans('Admin/coupons.coupon_title_in_sidebar') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('ProductCoupons.index') }}">{{ trans('Admin/coupons.coupon_title_in_sidebar') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a>{{ trans('Admin/coupons.edit_coupon_details') }} / {{ $coupon->code }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
        <!-- Start Content Body -->
        <div class="content-body">
            <!-- Start Zero configuration table -->
            <section id="configuration">
                <!-- Start row -->
                <div class="row">
                    <!-- Start col-12 -->
                    <div class="col-12">
                        <!-- Start Card -->
                        <div class="card">
                            <!-- Start Card Header -->
                            <div class="card-header">
                                <h4 class="card-title">
                                    <i class="material-icons">fiber_new</i>
                                    {{ trans('Admin/coupons.edit_coupon_details') }} / {{ $coupon->code }}
                                </h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Card Header -->
                            <!-- Start Card Content -->
                            <div class="card-content collapse show">
                                <!-- Start Card Body -->
                                <div class="card-body">
                                    <form action="{{ route('ProductCoupons.update',encrypt($coupon->id)) }}" method="post" autocomplete="off">
                                        @csrf
                                        @method('PATCH')
                                        <!-- Start Form Body -->
                                        <div class="form-body">
                                            <!-- Start First Row -->
                                            <div class="row">
                                                <!-- Start Code -->
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label><i class="material-icons">mode_edit</i> {{ trans('Admin/coupons.enter_coupon_code') }}</label>
                                                        <input type="text" id="codeEdit" name="code" value="{{ old('code', $coupon->code) }}" class="form-control" placeholder="{{ trans('Admin/coupons.enter_coupon_code_placeholder') }}" autocomplete="off" />
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
                                                                <option value="fixed" {{ old('type', $coupon->type) == 'fixed' ? 'selected' : null }}>{{ trans('Admin/coupons.fixed') }}</option>
                                                                <option value="percentage" {{ old('type', $coupon->type) == 'percentage' ? 'selected' : null }}>{{ trans('Admin/coupons.percentage') }}</option>
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
                                                        <input type="text" name="value" value="{{ old('value', $coupon->value) }}" class="form-control" placeholder="{{ trans('Admin/coupons.enter_value_placeholder') }}" autocomplete="off">
                                                        @error('value')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <!-- End Value -->
                                                <!-- Start Use Time -->
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label for="use_times"><i class="material-icons">format_list_numbered</i> {{ trans('Admin/coupons.use_time') }}</label>
                                                        <input type="number" name="use_times" value="{{ old('use_times' , $coupon->use_times) }}" class="form-control"  placeholder="{{ trans('Admin/coupons.enter_useTime_placeholder') }}" autocomplete="off">
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
                                                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $coupon->start_date->format('Y-m-d')) }}" class="form-control" autocomplete="off">
                                                        @error('start_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <!-- End Start Date -->
                                                <!-- Start Expired Date -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="expire_date"><i class="material-icons">date_range</i> {{ trans('Admin/coupons.expire_date') }}</label>
                                                        <input type="date" name="expire_date" id="expire_date" value="{{ old('expire_date', $coupon->expire_date->format('Y-m-d')) }}" class="form-control" autocomplete="off">
                                                        @error('expire_date')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <!-- End Expired Date -->
                                                <!-- Start Greater Than -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="greater_than"><i class="material-icons">grade</i> {{ trans('Admin/coupons.greater_than') }}</label>
                                                        <input type="number" name="greater_than" value="{{ old('greater_than', $coupon->greater_than) }}" class="form-control" autocomplete="off">
                                                        @error('greater_than')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                                <!-- End Greater Than -->
                                            </div>
                                            <!-- End Second Row -->

                                            <!-- Start Third Row -->
                                            <div class="row">
                                                <!-- Start Status Select -->
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="projectinput2">
                                                            <i class="material-icons">done</i>
                                                            {{ trans('Admin/coupons.choose_status') }}
                                                        </label>
                                                        <select name="status" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin/coupons.choose_type_placeholder') }}">
                                                                <option value="{{ ProductCoupon::ACTIVE }}" {{ old('status', $coupon->status) == ProductCoupon::ACTIVE ? 'selected' : null }}>{{ trans('Admin/coupons.active') }}</option>
                                                                <option value="{{ ProductCoupon::DISACTIVE }}" {{ old('status', $coupon->status) == ProductCoupon::DISACTIVE ? 'selected' : null }}>{{ trans('Admin/coupons.not_active') }}</option>
                                                            </optgroup>
                                                        </select>
                                                        @error('status')
                                                            <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Status Select -->
                                            </div>
                                            <!-- End Third Row -->

                                            <!-- Start Fourth Row -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="description"><i class="material-icons">mode_edit</i> {{ trans('Admin/coupons.description') }}</label>
                                                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $coupon->description) }}</textarea>
                                                        @error('description')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Fourth Row -->
                                            
                                            <!-- Start Form Action -->
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/site.edit') }}
                                                </button>
                                            </div>
                                            <!-- End Form Action -->
                                        </div>
                                        <!-- End Form Body -->
                                    </form>
                                </div>
                                <!-- End Card Body -->
                            </div>
                            <!-- End Card Content -->
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- End col-12 -->
                </div>
                <!-- End row -->
            </section>
            <!-- End Zero configuration table -->
        </div>
        <!-- End Content Body -->
    </div>
    <!-- End Content Wrapper -->
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/admin/js/myFun/pickadate/picker.js')}}"></script>
<script src="{{ asset('assets/admin/js/myFun/pickadate/picker.date.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
    selector: '#description',
    directionality : 'rtl',
    language: 'ar',
    height: 300,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist outdent indent | ' +
        'removeformat | help',
    content_css: '//www.tiny.cloud/css/codepen.min.css'
  });
</script>
@endsection