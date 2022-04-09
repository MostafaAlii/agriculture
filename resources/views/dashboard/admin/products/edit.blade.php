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
                <h3 class="content-header-title">{{trans('Admin\products.edit_product')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('products') }}">{{ __('Admin/products.productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" style="text-decoration: none; color: black;">
                                {{ trans('Admin\products.edit_product') }} / {{ $product->name }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/products.edit_product') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('product_update') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <!-- Start Form Body -->
                                        <div class="form-body">
                                            <!-- Start Main Product Photo -->
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="form-group">
                                                        <label>{{ trans('Admin/products.product_main_photo') }} <span class="text-danger">*</span></label>
                                                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                                                            <input type="file" accept="image/*" name="photo" onchange="loadFile(event)" />
                                                            <img  class="rounded-circle"  width="85px" height="85px" id="output" />
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
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/products.product_name_placeholder') }}" name="name" value="{{ $product->name }}" required>
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
                                                                            value="{{$farmer->id }}" <?php if($farmer->id==$product->farmer_id){echo'selected';}?>>{{$farmer->firstname . ' ' . $farmer->lastname}}</option>
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
                                                            {{ trans('Admin\products.product_category_select') }} <span class="text-danger">*</span>
                                                        </label>

                                                        <?php
                                                        $selected_department=array();
                                                        foreach ($product->categories as $department_select){
                                                             array_push($selected_department,$department_select->id);
                                                        }
                                                        ?>
                                                        <select name="categories[]" class="select2 form-control" multiple>
                                                            <optgroup label="{{ trans('Admin\products.product_category_select_placeholder') }}">
                                                                @if($categories && $categories->count() > 0)
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category->id}}" <?php if(in_array($category->id,$selected_department)){echo'selected';}?>>{{$category->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('categories.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- End Department Select -->
                                            </div>
                                            <!-- End Product Name -->

                                            <!-- Start Tags Multi Select -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_tags_select') }}
                                                        </label>
                                                        <?php
                                                        $selected_tags=array();
                                                        foreach ($product->tags as $tags_select){
                                                             array_push($selected_tags,$tags_select->id);
                                                        }
                                                        ?>
                                                        <select name="tags[]" class="select2 form-control" multiple>
                                                            <optgroup label="{{ trans('Admin\products.product_tags_select_placeholder') }}">
                                                                @if($tags && $tags->count() > 0)
                                                                    @foreach($tags as $tag)
                                                                        <option value="{{$tag->id}}" <?php if(in_array($tag->id,$selected_tags)){echo'selected';}?>>{{$tag->name}}</option>
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
                                                        <input type="number" name="price" value="{{ $product->price}}" class="form-control" placeholder="{{ trans('Admin/products.product_main_price_placeholder') }}" />
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
                                                            <?php if($product->status==1)echo 'checked';?>
                                                            />
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
                                                            {{$product->description}}
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
                                                    <input type="hidden" value="{{$product->id}}" name="id"/>
                                                    <i class="la la-check-square-o"></i> {{ __('Admin/site.edit') }}
                                                </button>
                                            </div>
                                        </div>
                                        <!-- End Form Body -->
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


<!-- ------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------- -->
<script>
$(document).ready(function () {

//---------------show all province of selected country------------------------//

$('select[name="country_id"]').on('change', function () {

   var country_id = $(this).val();
   if(country_id==''){
       $('#province_id').empty();
     //  $('#province_id').append('<option disabled >-- اختر من القائمه --</option>');
   }

   $('#area_id').empty();
   $('#state_id').empty();
   $('#village_id').empty();

   $.ajax({
       type: "GET",

       url: "{{ URL::to('dashboard_admin/fetch_provience')}}/" + country_id,
       //url: "../../fetch_provience/" + country_id,

       dataType: "json",
       success: function (data)
       {
          // alert(data);
          $('#province_id').empty();
           if(data!='')
           {
               $.each(data, function (key, value) {
                   //alert('<option value="' + key + '">' + value + '</option>');
               $('#province_id').append('<option value="' + key + '">' + value + '</option>');
               });
           }
           else
           {
               $('#province_id').append('<option disabled >'+ __('Admin/departments.no_province') +'</option>');
           }


       },
       error:function()
       { /*alert("false");*/ }
   });
});

//---------------show all area of selected provinece------------------------//

$('select[name="province_id"]').on('change', function () {

   var province_id = $(this).val();
   if(province_id==''){
       $('#area_id').empty();
      // $('#area_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
   }

   $('#state_id').empty();
   $('#village_id').empty();

   $.ajax({
       type: "GET",

       url: "{{ URL::to('dashboard_admin/fetch_area')}}/" + province_id,
    //    url: "../../fetch_area/" + province_id,

       dataType: "json",
       success: function (data)
       {
          // alert(data);

          $('#area_id').empty();

           if(data!='')
           {
               $.each(data, function (key, value) {
                   //alert('<option value="' + key + '">' + value + '</option>');
               $('#area_id').append('<option value="' + key + '">' + value + '</option>');
               });
           }
           else
           {
               $('#area_id').append('<option disabled> '+ __('Admin/departments.no_area') +'</option>');
           }


       },
       error:function()
       { /*alert("false");*/ }
   });
});

//---------------show all state of selected area------------------------//

$('select[name="area_id"]').on('change', function () {

   var area_id = $(this).val();
   if(area_id==''){
       $('#state_id').empty();
      // $('#state_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
   }

   $('#village_id').empty();
   $.ajax({
       type: "GET",

       url: "{{ URL::to('dashboard_admin/fetch_state')}}/" + area_id,
    //    url: "../../fetch_state/" + area_id,

       dataType: "json",
       success: function (data)
       {
          // alert(data);
          $('#state_id').empty();
           if(data!='')
           {
               $.each(data, function (key, value) {
                   //alert('<option value="' + key + '">' + value + '</option>');
               $('#state_id').append('<option value="' + key + '">' + value + '</option>');
               });
           }
           else
           {
               $('#state_id').append('<option disabled> '+ __('Admin/departments.no_state') +'</option>');
           }


       },
       error:function()
       { /*alert("false");*/ }
   });
});

//---------------show all village of selected state------------------------//

$('select[name="state_id"]').on('change', function () {

   var state_id = $(this).val();
   if(state_id==''){
       $('#village_id').empty();
      // $('#village_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
   }

   $.ajax({
       type: "GET",

       url: "{{ URL::to('dashboard_admin/fetch_village')}}/" + state_id,
    //    url: "../../fetch_village/" + state_id,

       dataType: "json",
       success: function (data)
       {
          // alert(data);
          $('#village_id').empty();
           if(data!='')
           {
               $.each(data, function (key, value) {
                   //alert('<option value="' + key + '">' + value + '</option>');
               $('#village_id').append('<option value="' + key + '">' + value + '</option>');
               });
           }
           else
           {
               $('#village_id').append('<option disabled> '+ __('Admin/departments.no_village') +'</option>');
           }


       },
       error:function()
       { /*alert("false");*/ }
   });
});






});
</script>
<!-- ------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------- -->

@endsection
