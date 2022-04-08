@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
{{ __('Admin/site.blog') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{ __('Admin/site.blog') }}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">{{ __('Admin/site.blog') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Admin/site.edit') }}
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.newblog') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('blogs.update', encrypt($blog->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="eventRegInput1">{{ __('Admin/site.title') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" id="eventRegInput1" class="form-control"
                                                        placeholder="{{ __('Admin/site.title') }}"
                                                        name="title" value="{{ old('title',$blog->title) }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="{{ __('Admin/site.body') }}">{{ __('Admin/site.body') }}<span
                                                        class="text-danger">*</span>
                                                    </label>
                                                    <textarea name="body" rows="5"
                                                            placeholder="{{ __('Admin/site.body') }}"
                                                            class="form-control" required>
                                                            {{ old('body',$blog->body) }}
                                                    </textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>{{ __('Admin/site.image') }} :  <span style="color:rgb(199, 8, 8)">*</span></label>
                                                            <input class="form-control img" name="image"  type="file" accept="image/*">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                    <img src="{{ asset('Dashboard/img/blogs/'. $blog->image->filename) }}" class="img-thumbnail img-preview" width="100" alt="">
                                                    </div>
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="eventRegInput4">{{ __('Admin/site.admin') }}<span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <select name="admin_id" class="select2 form-control">
                                                        <optgroup label="{{ __('Admin/site.select') }}">
                                                        @if($admins->count() > 0)
                                                            @foreach($admins as $admin)
                                                                <option value="{{$admin->id }}" <?php if($admin->id==$blog->admin_id){echo'selected';}?>>
                                                                    {{$admin->firstname}} {{$admin->lastname}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                    </select>
                                                </div>

                                                <!-- Start Categories Select -->
                                                <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{ trans('Admin\products.product_category_select') }} <span class="text-danger">*</span>
                                                        </label>
                                                        <?php
                                                        $selected_category=array();
                                                        foreach ($blog->categories as $cates_select){
                                                            array_push($selected_category,$cates_select->id);
                                                        }
                                                        ?>
                                                    
                                                        <select name="categories[]" class="select2 form-control" multiple>
                                                            <optgroup label="{{ trans('Admin\products.product_category_select_placeholder') }}">
                                                                @if($categories && $categories->count() > 0)
                                                                    @foreach($categories as $category)
                                                                        <option
                                                                            value="{{$category->id}}" <?php if(in_array($category->id,$selected_category)){echo'selected';}?>>{{$category->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('categories.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                            
                                                <!-- End Categories Select -->


                                                <div class="form-group">
                                                    <label for="projectinput1">
                                                        {{ trans('Admin\products.product_tags_select') }}
                                                    </label>
                                                    <?php
                                                    $selected_tags=array();
                                                    foreach ($blog->tags as $tags_select){
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

