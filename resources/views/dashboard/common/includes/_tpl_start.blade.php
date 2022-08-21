<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl" >
    {{-- oncontextmenu="return false" --}}
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
    <img class="img-logo img-fluid lazy" src="{{URL::asset('Dashboard/img/settingIcon/'.setting()->site_icon)}}"
    data-src="{{URL::asset('Dashboard/img/settingIcon/'.setting()->site_icon)}}" width="70" height="70"
    alt="demo"  style="left: 45%;    width: 70px;height: 70px;"/>

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
        {{-- font cairo --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/i18n/datepicker.ar-AE.min.js" integrity="sha512-heSw7GMfC3mSzYovnKDmr34vA2m2yLMT4efh4W3V0DwgmXDQKDxsflaZcX7lGl+zDkZmUwk4vI7KuCBnueGykA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
        body {font-family: 'Cairo', sans-serif !important;}
        .navigation{
            font-family: 'Cairo', sans-serif !important;
        }
        h1,h2,h3,h4,h5,h6{
            font-family: 'Cairo', sans-serif !important;
        }
        .breadcrumb-item{
            font-family: 'Cairo', sans-serif !important;
        }
        </style>
        {{-- font cairo --}}
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/ui/prism.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/custom-rtl.css') }}">
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/plugins/file-uploaders/dropzone.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/myFun/pickadate/themes/rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/pages/user-feed.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/plugins/forms/wizard.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/js/treeview/treeview-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/style-rtl.css') }}">
    @elseif(app()->getLocale() == 'ku')
        {{-- font cairo --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/i18n/datepicker.ar-AE.min.js" integrity="sha512-heSw7GMfC3mSzYovnKDmr34vA2m2yLMT4efh4W3V0DwgmXDQKDxsflaZcX7lGl+zDkZmUwk4vI7KuCBnueGykA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <style>
        body {font-family: 'Cairo', sans-serif !important;}
        .navigation{
            font-family: 'Cairo', sans-serif !important;
        }
        h1,h2,h3,h4,h5,h6{
            font-family: 'Cairo', sans-serif !important;
        }
        .breadcrumb-item{
            font-family: 'Cairo', sans-serif !important;
        }
        </style>
        {{-- font cairo --}}
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/vendors-rtl.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/components.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/custom-rtl.css') }}">
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/plugins/file-uploaders/dropzone.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/js/myFun/pickadate/themes/rtl.css')}}">
        <!-- END: Page CSS-->
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/pages/user-feed.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/plugins/forms/wizard.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/js/treeview/treeview-rtl.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css-rtl/style-rtl.css') }}">
    @else
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/i18n/datepicker.en-US.min.js" integrity="sha512-j8zadPEIgyqSe1Lo4LaxHZdaMCxdo4dq4O+3cYo5i3ldZ2lqVa+nTiYSDaSW804Wqd0l5ZrRqRSBgKKCtbOPtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
        <!-- END: Vendor CSS-->
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/bootstrap-extended.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/components.css') }}">
        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/file-uploaders/dropzone.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/forms/wizard.css')}}">
        <!-- END: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
        <!-- END: Theme CSS-->
        <!-- BEGIN: Page CSS-->
    @endif
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/select2-bootstrap4.min.css') }}">
    <script src="{{ asset('assets/admin/js/jquery-3.6.0-jquery.min.js')}}"></script>
    <script src="{{ asset('assets/admin/js/multiple-select.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/selects/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/multiple-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/all.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/fontawesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/js/treeview/treeview.css')}}">
    <script src="{{ asset('assets/admin/js/all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/admin/noty/noty.css') }}">
    <script src="{{ asset('assets/admin/noty/noty.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/cryptocoins/cryptocoins.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/jstree/themes/default/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/pages/user-feed.css') }}">
    @toastr_css
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/multiple-select.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/ticker.css') }}">
    @yield('css')
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu material-vertical-layout material-layout 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="2-columns">
