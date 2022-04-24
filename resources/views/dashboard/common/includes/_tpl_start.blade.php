<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>{{ trans('Admin/dashboard.dashboard') }} | @yield('pageTitle')</title>

    <link rel="apple-touch-icon" href="{{ asset('assets/admin/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/material-icons/material-icons.css') }}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/weather-icons/climacons.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/fonts/simple-line-icons/style.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/file-uploaders/dropzone.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/myFun/pickadate/themes/classic.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/myFun/pickadate/themes/classic.date.css')}}">
    @if(app()->getLocale()=='ar')
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/custom-rtl.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material-extended.css') }}"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/material-colors.css') }}"> --}}
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/plugins/file-uploaders/dropzone.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/myFun/pickadate/themes/rtl.css')}}">
        <!-- END: Page CSS-->
        <!-- BEGIN: Page CSS-->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/menu-types/material-vertical-menu.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/pages/user-feed.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/style-rtl.css') }}">

    @else
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material.css') }}"> --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/components.css') }}">
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material-extended.css') }}"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/material-colors.css') }}"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/custom.css') }}"> --}}
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/file-uploaders/dropzone.css')}}">
        <!-- END: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
        {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/menu/menu-types/material-vertical-menu.css') }}"> --}}
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/select2-bootstrap4.min.css') }}">

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('assets/admin/noty/noty.css') }}">
    <script src="{{ asset('assets/admin/noty/noty.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/animate/animate.css')}}">
    {{--noty--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/jstree/themes/default/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/user-feed.css') }}">

    <!-- END: Page CSS-->
    @toastr_css
    <!-- BEGIN: Custom CSS-->
    <!-- END: Custom CSS-->
    <script src="{{ asset('assets/admin/js/jquery-3.6.0-jquery.min.js')}}"></script>

    @yield('css')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu material-vertical-layout material-layout 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
