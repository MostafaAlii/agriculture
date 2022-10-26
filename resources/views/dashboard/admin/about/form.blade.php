@extends('dashboard.layouts.dashboard')
@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"
            integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/about.about_title') }}
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
                                        href="{{ route('about_us/show') }}">{{trans('Admin\about.about_title')}}</a>
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
                                    id="basic-layout-form">{{trans('Admin\about.about_title')}}</h4>
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
                                            <h4 class="form-section"> <i class="material-icons"> info </i> {{trans('Admin\about.brief')}}
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('Admin\about.title')}}</label>
                                                        <input type="text" id="name" class="form-control"
                                                               placeholder="{{trans('Admin\about.title')}}"
                                                               name="name"
                                                               value="{{ $info->title ?? '' }}">
                                                        <input type="hidden" id="id" class="form-control" name="id" value="{{$info->id ?? ''}}"
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php
                                                            if(isset($info->image)){
                                                                $src=$info->image;
                                                            }else{
                                                                $src='104.jpg';
                                                            }
                                                        ?>
                                                        <label>{{trans('Admin\about.image')}} </label>

                                                            <input type="file" accept="image/*" name="image"  onchange="readURL(this);">
                                                            <img src="{{asset('Dashboard/img/about/'.$src)}}"  id="previewImg" class="img-thumbnail img-preview" width="100px" height="100px" alt="image" id="output">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col col-md-12">
                                                    <div class="form-group">
                                                        <label for="description">{{trans('Admin\about.desc')}}</label>
                                                        <textarea type="text" id="description" class="form-control"
                                                               placeholder="{{trans('Admin\about.desc')}}"
                                                                  name="description">
                                                            {!! old('description',$info->description ?? '') !!}
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

            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
    </div>
    <!-- END: Content-->

@endsection
@section('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
