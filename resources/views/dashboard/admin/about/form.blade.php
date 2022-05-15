@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/setting.settingPageTitle') }}
@endsection
@section('content')
    @include('dashboard\common\_partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\setting.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                        href="{{ route('admin.dashboard') }}">{{trans('Admin\setting.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                        href="{{ route('settings') }}">{{trans('Admin\setting.settings')}}</a>
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
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"
                                    id="basic-layout-form">{{trans('Admin\setting.setting_info')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">

                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                        <p></p>
                                    </div>
                                    <form class="form" action="{{route('about_us/save')}}" method="post"
                                          enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i
                                                        class="ft-settings"></i> {{trans('Admin\setting.setting_info')}}
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('Admin\setting.site_name')}}</label>
                                                        <input type="text" id="name" class="form-control"
                                                               placeholder="{{trans('Admin\setting.site_name')}}"
                                                               name="name"
                                                               value="{{$info->title}}">
                                                        <input type="hidden" id="id" class="form-control" name="id" value="{{$info->id}}"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('Admin\setting.site_logo')}} </label>

                                                            <input type="file" accept="image/*" name="image"  onchange="readURL(this);">
                                                            <?php
                                                            if(isset($info->image->filename)){
                                                                $src=$info->image->filename;
                                                            }else{
                                                                $src='12.jpg';
                                                            }
                                                            ?>
                                                            <img src="{{asset('Dashboard/img/about/'.$src)}}"  id="previewImg" class="img-thumbnail img-preview" width="100px" height="100px" alt="image" id="output">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">{{trans('Admin\setting.address')}}</label>
                                                        <textarea type="text" id="description" class="form-control"
                                                               placeholder="{{trans('Admin\setting.address')}}"
                                                                  name="description">
                                                            {{ old('description',$info->description) }}
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="form-actions">
                                                
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> {{trans('Admin\setting.save')}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
@foreach($about_cache as $cc)
{{$cc->title}}<br>{{$cc->image->filename}}
@endforeach
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
@section('js')

    <script type="text/javascript">

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previewImg')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
