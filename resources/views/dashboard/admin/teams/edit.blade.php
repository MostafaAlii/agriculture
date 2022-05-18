@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/about.review_title') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">playlist_add_check</i>
                    {{ trans('Admin/about.review_title') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('team.index') }}">{{ trans('Admin/about.review_title') }}</a>
                            </li>
                        </ol>
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
        </div>
        <!-- End Breadcrumbs -->
        <!-- Start Content Body -->
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row justify-content-md-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/about.review_title') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('team.update', encrypt($team->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.name') }}</label>
                                                <input type="text" name="name" class="form-control" value="{{ old('name',$team->name) }}" required/>
                                                @error('name')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.position') }}</label>
                                                <input type="text" name="position" class="form-control" value="{{ old('position',$team->position) }}" required />
                                                @error('position')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/about.description') }}</label>
                                                <textarea type="text" id="description" class="form-control"
                                                        placeholder="{{trans('Admin\about.desc')}}"
                                                            name="description">
                                                    {!! $team->description !!}
                                                </textarea>
                                                @error('description')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <?php
                                                    if(isset($team->image)){
                                                        $src=$team->image;
                                                    }else{
                                                        $src='104.jpg';
                                                    }
                                                ?>
                                                <label>{{trans('Admin\about.image')}} </label>

                                                    <input type="file" accept="image/*" name="image"  onchange="readURL(this);">
                                                    <img src="{{asset('Dashboard/img/team/'.$src)}}"  id="previewImg" class="img-thumbnail img-preview" width="100px" height="100px" alt="image" id="output">
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
        <!-- End Content Body -->
    </div>
<!-- End Content Wrapper -->
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