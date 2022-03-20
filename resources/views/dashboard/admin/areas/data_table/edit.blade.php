@extends('dashboard.layouts.dashboard')
@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/areas.areaPageTitle') }}
@endsection

@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start Content Wrapper -->
    <div class="content-wrapper">
        <!-- Start Breadcrumbs -->
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">
                    <i class="material-icons">flag</i>
                    {{ trans('Admin/areas.areaPageTitle') }}
                </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('Admin/dashboard.dashboard_page_title') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Areas.index') }}">{{ trans('Admin/areas.areaPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#" style="text-decoration: none; color: black;">
                                {{ trans('Admin/proviences.proviencePageTitle_edit') }} / {{ $area->name }}</a>
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
                                <h4 class="card-title" id="basic-layout-card-center">{{ __('Admin/site.newadmin') }}</h4>
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
                                    <form class="form" method="post" action="{{ route('Areas.update', encrypt($area->id)) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="form-body">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>
                                                        <i class="material-icons">mode_edit</i> 
                                                        {{ trans('Admin/areas.area_name') }}
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" id="eventRegInput1" class="form-control"  name="name" value="{{ old('name',$area->name) }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-6">
                                                <label for="projectinput2">
                                                    <i class="material-icons">flag</i>
                                                    {{ trans('Admin/areas.choose_provience_name') }}
                                                </label>
                                                <select name="province_id" class="select2 form-control">
                                                    <optgroup label="{{ trans('Admin/areas.choose_provience_name') }}">
                                                        @if($proviences && $proviences-> count() > 0)
                                                            @foreach($proviences as $provience)
                                                                <option value="{{$provience->id }}" {{$provience->id == $area->provience_id ? 'selected' : '' }}>
                                                                    {{$provience->name}}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error('provience_id')
                                                <span class="text-danger"> {{$message}}</span>
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