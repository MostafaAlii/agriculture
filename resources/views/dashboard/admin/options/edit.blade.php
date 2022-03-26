@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/options.options') }}
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
                    {{ trans('Admin/options.options') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Options.index') }}">{{ trans('Admin/options.options') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" style="text-decoration: none; color: black;">
                                {{ trans('Admin/options.options_edit') }} / {{ $options->name }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/options.options_edit_title') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('Options.update', encrypt($options->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">
                                           <div class="form-group">
                                                <label><i class="material-icons">mode_edit</i> {{ trans('Admin/options.options_add_opt_name') }}</label>
                                                <input type="text" name="name" class="form-control" value="{{$options->name}}" placeholder="{{ trans('Admin/options.options_add_opt_name') }}" />
                                                @error('name')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label><i class="material-icons">attach_money</i> {{ trans('Admin/options.options_price') }}</label>
                                                <input type="number" name="price" class="form-control" value="{{$options->price}}" placeholder="{{ trans('Admin/options.options_add_opt_price') }}" />
                                                @error('price')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>{{ __('Admin/options.attribute') }}</label>
                                                <select class="form-control" name="attribute_id" >
                                                        @foreach($attributes as $attr)
                                                            <option value="{{$attr->id}}" <?php if($options->attribute_id==$attr->id){echo "selected";}?>>{{$attr->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @error('attribute_id')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                        

                                            <div class="form-group">
                                                <label>{{ __('Admin/options.all_product') }}</label>
                                                <select class="form-control" name="product_id" id="product_id">
                                                        @foreach($products as $pro)
                                                            <option value="{{$pro->id}}"  <?php if($options->product_id==$pro->id){echo "selected";}?>>{{$pro->name}}</option>
                                                        @endforeach
                                                    </select>
                                                @error('product_id')
                                                    <small class="form-text text-danger">{{$message}}</small>
                                                @enderror
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