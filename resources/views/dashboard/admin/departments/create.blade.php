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
                            <li class="breadcrumb-item active">{{ __('Admin/site.add') }}
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/departments.depart_add') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('Departments.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('post')
                                        <div class="form-body">
                                            <div class="row">
                                                
                                                <!-- ----------------------------------------------------------------------- -->
                                                <!-- ------------------full address select,options ----------------------- -->
                                                @include('dashboard.admin.departments.select_full_address')
                                                <!-- ----------------------------------------------------------------------- -->
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/departments.depart_select') }}<span class="text-danger">*</span></label>
                                                        <!-- custom-select select2 form-control -->
                                                        <select class="custom-select" id="customSelect" name="parent_id" required>
                                                         <option value='0' selected>{{ __('Admin/departments.depart_main_type') }}</option>
                                                            @foreach($main_departments as $main)
                                                                     <?php
                                                                    $color="#c20620";
                                                                    $new=[
                                                                        'childs' => $main->childs,
                                                                        'color'=>'#209c41',
                                                                        'number'=>2,
                                                                        'depart_id'=>'',
                                                                       // 'depart_id'=>$main->id,
                                                                        'parent_id'=>'',
                                                                    ];
                                                                     ?>
                                                                    <option style="color:<?php echo $color;?>"  value="{{$main->id}}">-{{$main->name}}</option>
                                                                    <!-- @if(count($main->childs)) -->
                                                                        @include('dashboard.admin.departments.mangeChild',$new)
                                                                    <!-- @endif -->
                                                             @endforeach
                                                        </select>
                                                        @error('parent_id')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                     </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('Admin/departments.depart_name') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput1" class="form-control" placeholder="{{ __('Admin/departments.depart_name') }}" name="name" value="{{ old('name') }}" required>
                                                        @error('name')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/departments.depart_slug') }}<span class="text-danger">*</span></label>
                                                        <input type="text" id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/departments.depart_slug') }}" name="slug" value="{{ old('slug') }}" required>
                                                        @error('slug')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!-- ----------------------------------------------------------------------- -->
                                               
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/departments.depart_desc') }}<span class="text-danger">*</span></label>
                                                        <textarea id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/departments.depart_desc') }}" name="description">{{ old('description') }}</textarea>
                                                        @error('description')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eventRegInput4">{{ __('Admin/departments.depart_keyword') }}<span class="text-danger">*</span></label>
                                                        <textarea id="eventRegInput4" class="form-control" placeholder="{{ __('Admin/departments.depart_keyword') }}" name="keyword">{{ old('keyword') }}</textarea>
                                                        @error('keyword')
                                                            <small class="form-text text-danger">{{$message}}</small>
                                                        @enderror
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
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
<script src="{{ URL::asset('/js/full_address/select_script.js') }}"></script>

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

@endsection

