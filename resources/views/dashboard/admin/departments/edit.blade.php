@extends('dashboard.layouts.dashboard')

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('pageTitle')
    {{ trans('Admin/departments.departmentPageTitle') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ trans('Admin/departments.departmentPageTitle') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Departments.index') }}">{{ trans('Admin/departments.departmentPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.edit') }} / {{$depart->name}}
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/departments.depart_edit') }} / {{$depart->name}}</h4>
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
                                    <form method="POST" action="{{route('Departments.update',$depart->id)}}" enctype="multipart/form-data">
                                        {{method_field('PATCH ')}}
                                            @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                       <!-- ------------------full address select,options ----------------------- -->
                                                       @include('dashboard.admin.departments.select_full_address')
                                                <!-- ----------------------------------------------------------------------- -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <br>
                                                        <label for="eventRegInput1">{{ __('Admin/departments.depart_select') }}<span class="text-danger">*</span></label>
                                                         <select class="custom-select" id="customSelect" name="parent_id" required>
                                                         <option value='0' <?php if($depart->parent_id == NULL){echo'selected';}?>>{{ __('Admin/departments.depart_main_type') }}</option>
                                                            @foreach($main_departments as $main)
                                                                     <?php
                                                                    $color="#c20620";
                                                                    $new=[
                                                                        'childs' => $main->childs,
                                                                        'color'=>'#209c41',
                                                                        'number'=>2,
                                                                        'depart_id'=>$depart->id,//pramiry key of department we edit on it 
                                                                        'parent_id'=>$depart->parent_id,//parent_id of another department
                                                                                                                                                
                                                                    ];
                                                                     ?>
                                                                    <option style="color: {{$color}};"  value="{{$main->id}}" <?php if($depart->parent_id == $main->id){echo'selected';}?>>-{{$main->name}}</option>
                                                                    @if(count($main->childs))
                                                                        @include('dashboard.admin.departments.mangeChild',$new)
                                                                    @endif
                                                             @endforeach
                                                        </select>
                                                        @error('parent_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                     </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/departments.depart_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/departments.depart_name') }}" name="name" value="{{ $depart->name }}" required>
                                                        @error('name')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                   
                                                 
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/departments.depart_desc') }}<span class="text-danger">*</span></label>
                                                        <textarea id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/departments.depart_desc') }}" name="description">{{ $depart->description }}</textarea>
                                                        @error('description')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/departments.depart_keyword') }}<span class="text-danger">*</span></label>
                                                        <textarea id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/departments.depart_keyword') }}" name="keyword">
                                                            <?php
                                                            $f_step=str_replace('<span class="badge bg-secondary">'," ",$depart->keyword) ;
                                                            $s_step= str_replace('</span>'," ",$f_step) ;
                                                            echo str_replace('<br/>',"\n\r",$s_step) ;
                                                            ?>
                                                          
                                                        </textarea>
                                                        @error('keyword')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                  
                                                    
                                                </div>
                                                <input type="hidden" name="id" value="{{$depart->id}}"/>
                                            </div>
                                            

                                        <div class="form-actions center">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('Admin/site.save') }}
                                            </button>
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

<!-- add script for categories and changes on it -->
<!-- <script src="{{ URL::asset('/js/full_address/select_script.js') }}"></script> -->

    <script type="text/javascript">

        var loadFile = function (event) {
            var img = document.getElementById('output');
            img.src = URL.createObjectURL(event.target.files[0]);
            output.img = function () {
                URL.revokeObjectURL(img.src)
            }

        };
    </script>

    <script type="text/javascript">

        var loadFile1 = function (event) {
            var output = document.getElementById('output1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src)
            }

        };
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- ------------------------------------------------------------------------------------- -->
<!-- ------------------------------------------------------------------------------------- -->
<script>
$(document).ready(function () {

//---------------show all province of selected country------------------------//

$('select[name="country_id"]').on('click', function () {

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

$('select[name="province_id"]').on('click', function () {

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

$('select[name="area_id"]').on('click', function () {

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

$('select[name="state_id"]').on('click', function () {

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

