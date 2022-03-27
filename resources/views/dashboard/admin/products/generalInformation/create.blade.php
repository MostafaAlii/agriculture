@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/products.productPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\products.add_new_product')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('products') }}">{{ __('Admin/products.productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('products.generalInformation') }}">{{ __('Admin/products.add_new_product') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>

                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/products.add_new_product') }}</h4>
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
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form" method="post" action="{{ route('products.generalInformation') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">
                                            <!-- Start Main Product Photo -->
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>{{ trans('Admin/products.product_main_photo') }} <span class="text-danger">*</span></label>
                                                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                                                            <input type="file" accept="image/*" name="photo" onchange="loadFile(event)" />
                                                            <img style="" class="rounded-circle"  width="85px" height="85px" id="output" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Main Product Photo -->
                                            <!-- Start Product Name -->
                                            <div class="row">
                                                <!-- Start Product Name -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/products.product_name') }} <span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/products.product_name_placeholder') }}" name="name" value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Product Name -->

                                                <!-- Start Farmer Select List -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_farmer_select') }} <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="farmer_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_farmer_select_placeholder') }}">
                                                                @if($farmers && $farmers->count() > 0)
                                                                    @foreach($farmers as $farmer)
                                                                        <option
                                                                            value="{{$farmer->id }}">{{$farmer->firstname . ' ' . $farmer->lastname}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('farmer_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Farmer Select List -->
                                                <!-- Start Department Select -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_department_select') }} <span class="text-danger">*</span>
                                                        </label>
                                                        <select name="departments[]" class="select2 form-control" multiple>
                                                            <optgroup label="{{ trans('Admin\products.product_department_select_placeholder') }}">
                                                                @if($departments && $departments->count() > 0)
                                                                    @foreach($departments as $department)
                                                                        <option
                                                                            value="{{$department->id}}">{{$department->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('departments.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Department Select -->
                                            </div>
                                            <!-- End Product Name -->

                                            <!-- Start Country Dropdown List -->
                                            <div class="row" >
                                                <!-- Start Country -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_country_select') }}
                                                        </label>
                                                        <select name="country_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_country_select_placeholder') }}">
                                                                @if($countries && $countries->count() > 0)
                                                                    @foreach($countries as $country)
                                                                        <option
                                                                            value="{{$country->id }}">{{$country->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('country_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Country -->
                                            </div>
                                            <!-- End Country Dropdown List -->

                                            <!-- Start Provience and Other Dropdown List -->
                                            <div class="row" >
                                                <!-- Start Provience -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_provience_select') }}
                                                        </label>
                                                        <select name="province_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_provience_select_placeholder') }}">
                                                                @if($provinces && $provinces->count() > 0)
                                                                    @foreach($provinces as $provincy)
                                                                        <option
                                                                            value="{{$provincy->id }}">{{$provincy->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('province_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Provience -->
                                                <!-- Start Area -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_area_select') }}
                                                        </label>
                                                        <select name="area_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_area_select_placeholder') }}">
                                                                @if($areas && $areas->count() > 0)
                                                                    @foreach($areas as $area)
                                                                        <option
                                                                            value="{{$area->id }}">{{$area->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('area_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Area -->
                                                <!-- Start State -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_state_select') }}
                                                        </label>
                                                        <select name="state_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_state_select_placeholder') }}">
                                                                @if($states && $states->count() > 0)
                                                                    @foreach($states as $state)
                                                                        <option
                                                                            value="{{$state->id }}">{{$state->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('state_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End State -->
                                                <!-- Start Village -->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_village_select') }}
                                                        </label>
                                                        <select name="village_id" class="select2 form-control">
                                                            <optgroup label="{{ trans('Admin\products.product_village_select_placeholder') }}">
                                                                @if($villages && $villages->count() > 0)
                                                                    @foreach($villages as $village)
                                                                        <option
                                                                            value="{{$village->id }}">{{$village->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('village_id')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End State -->
                                            </div>
                                            <!-- End Provience and Other Dropdown List -->

                                            <!-- Start Tags Multi Select -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_tags_select') }}
                                                        </label>
                                                        <select name="tags[]" class="select2 form-control" multiple>
                                                            <optgroup label="{{ trans('Admin\products.product_tags_select_placeholder') }}">
                                                                @if($tags && $tags->count() > 0)
                                                                    @foreach($tags as $tag)
                                                                        <option
                                                                            value="{{$tag->id}}">{{$tag->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('tags.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_main_price') }}
                                                        </label>
                                                        <input type="number" name="price" class="form-control" placeholder="{{ trans('Admin/products.product_main_price_placeholder') }}" />
                                                        @error('price')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Tags Multi Select -->

                                            <!-- Start Product Status -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" value="1"
                                                            name="status"
                                                            id="switcheryColor4"
                                                            class="js-switch" data-color="success"
                                                            checked/>
                                                        <label for="switcheryColor4"
                                                            class="card-title ml-1">{{ trans('Admin\products.product_status') }}</label>

                                                        @error("status")
                                                        <span class="text-danger">{{$message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Product Status -->
                                            <hr>

                                            <!-- Start Product Description -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_description') }}
                                                        </label>
                                                        <textarea name="description" class="form-control" id="description" placeholder="{{ trans('Admin\products.product_description_placeholder') }}">
                                                            {{old('description')}}
                                                        </textarea>

                                                        @error("description")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Product Description -->
                                            

                                            
                                            <div class="form-actions center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>
<!-- END: Content-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    var loadFile = function (event) {
        var img = document.getElementById('output');
        img.src = URL.createObjectURL(event.target.files[0]);
        output.img = function () {
            URL.revokeObjectURL(img.src)
        }

    };
</script>
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