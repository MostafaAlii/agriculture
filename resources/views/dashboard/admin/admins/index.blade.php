@extends('dashboard.layouts.dashboard')
@section('css')
@endsection
@section('pageTitle')
    {{ trans('Admin/admins.settingPageTitle') }}
@endsection
@section('content')
<div class="content-wrapper">
        <!-- Start Content Header -->
        <div class="content-header row">
            <!-- Start content-header-left & Breadcrumb -->
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">{{trans('Admin\setting.dashboard')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{trans('Admin\setting.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Admins.index') }}">{{trans('Admin\admins.page_title_in_sidebar')}}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- End content-header-left & Breadcrumb -->
            <div class="content-header-right col-md-6 col-12">
                <div class="media width-250 float-right">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>
                </div>
            </div>
        </div>
        <!-- End Content Header -->
        <!-- Start Content Body -->
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">xxxxxxx</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">

                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="card-text">
                                        <p></p>
                                    </div>
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
    <!--End Content Body -->
@endsection
@section('js')

@endsection