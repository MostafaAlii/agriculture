@extends('dashboard.layouts.dashboard')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css" integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" integrity="sha512-uyGg6dZr3cE1PxtKOCGqKGTiZybe5iSq3LsqOolABqAWlIRLo/HKyrMMD8drX+gls3twJdpYX0gDKEdtf2dpmw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('pageTitle')
    {{ trans('Admin/products.productPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <!-- Start content-wrapper -->
    <div class="content-wrapper">
        <!-- Start content-header -->
        <div class="content-header row">
            <div class="mb-2 content-header-left col-md-6 col-12">
                <h3 class="content-header-title">{{trans('Admin\products.add_or_edit_product')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Admin/site.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('Products.index') }}">{{ __('Admin/products.productPageTitle') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{ route('Products.create') }}">{{ __('Admin/products.add_or_edit_product') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="content-header-right col-md-6 col-12">
                <div class="float-right media width-250">
                    <media-left class="media-middle">
                        <div id="sp-bar-total-sales"></div>
                    </media-left>
                </div>
            </div>
        </div>
        <!-- End content-header -->
        <!-- Start content-body -->
        <div class="content-body">
            <!-- Start card-content -->
            <div class="card-content collapse show">
                <div class="card-body">
                    <!-- Start Product Wizard -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">{{trans('Admin\products.add_or_edit_product')}}</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="mb-0 list-inline">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Start Product Create -->
                                    <section id="material-fixed-tabs" class="material-fixed-tabs">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-content collapse show">
                                                        <div class="card-body">
                                                            <form class="form" id="product_form" method="post" action="{{ route('Products.update', encrypt($product->id)) }}" enctype="multipart/form-data" autocomplete="off">
                                                                @csrf
                                                                @method('put')
                                                                <!-- Start Upper Btn -->
                                                                <a class="btn btn-success save">
                                                                    <i class="fa fa-arrow-down" aria-hidden="true"> </i>
                                                                    {{ trans('Admin/general.save') }}
                                                                </a>
                                                                <a class="btn btn-info save_and_continue">
                                                                    <i class="fa fa-angle-double-left" aria-hidden="true"> </i>
                                                                    {{ trans('Admin/products.save_and_continue') }}
                                                                    <i class="hidden fa fa-spin fa-spinner loading_save_and_continue"></i>
                                                                </a>
                                                                <a class="btn btn-danger delete">
                                                                    <i class="fa fa-undo" aria-hidden="true"> </i>
                                                                    {{ trans('Admin/products.back') }}
                                                                </a>
                                                                <!-- End Upper Btn -->
                                                                <hr>
                                                                <!-- Start Tabs Ul Links -->
                                                                <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                                                                    <!-- Start generalInformation Link -->
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" id="generalInformation-tab" data-toggle="tab" href="#generalInformation" aria-controls="generalInformation" aria-expanded="true">
                                                                            <i class="fa fa-info"></i>
                                                                            {{ trans('Admin/products.general_product_information') }}
                                                                        </a>
                                                                    </li>
                                                                    <!-- End generalInformation Link -->
                                                                    <!-- Start productSetting Link -->
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="productSetting-tab" data-toggle="tab" href="#productSetting" aria-controls="productSetting" aria-expanded="false">
                                                                            <i class="fa fa-cog"></i>
                                                                            {{ trans('Admin/products.product_setting') }}
                                                                        </a>
                                                                    </li>
                                                                    <!-- End productSetting Link -->
                                                                    <!-- Start productOtherData Link -->
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" id="productOtherData-tab" data-toggle="tab" href="#productOtherData" aria-controls="productOtherData">
                                                                            <i class="fa fa-database"></i>
                                                                            {{ trans('Admin/products.product_other_data') }}
                                                                        </a>
                                                                    </li>
                                                                    <!-- End productOtherData Link -->
                                                                </ul>
                                                                <!-- End Tabs Ul Links -->
                                                                <!-- Start Tabs UL Content -->
                                                                <div class="px-1 pt-1 tab-content">
                                                                    <!-- Start generalInformation Content -->
                                                                    @include('dashboard.admin.products.tabs.generalInformation')
                                                                    <!-- End generalInformation Content -->

                                                                    <!-- Start productSetting Content -->
                                                                    @include('dashboard.admin.products.tabs.productSetting')
                                                                    <!-- End productSetting Content -->

                                                                    <!-- Start productOtherData Content -->
                                                                    @include('dashboard.admin.products.tabs.productOtherData')
                                                                    <!-- End productOtherData Content -->
                                                                </div>
                                                                <!-- End Tabs Ul Content -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- End Product Create -->
                                </div>
                            </div>
                        </div>
                    <!-- End Product Wizard -->
                </div>
                <!-- End card-content -->
            </div>
        </div>
        <!-- End content-body -->
    </div>
    <!-- End content-wrapper -->
</div>
<!-- END: Content-->
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js" integrity="sha512-lC8vSUSlXWqh7A/F+EUS3l77bdlj+rGMN4NB5XFAHnTR3jQtg4ibZccWpuSSIdPoPUlUxtnGktLyrWcDhG8RvA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js" integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.js" integrity="sha512-cG69LpvCJkui4+Uuj8gn/zRki74/E7FicYEXBnplyb/f+bbZCNZRHxHa5qwci1dhAFdK2r5T4dUynsztHnOS5g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    $('.datepicker').datepicker({
        rtl:'{{ App::getLocale()=='ar'?true:false }}',
        language: '{{ App::getLocale() }}',
        format:'yyyy-mm-dd',
        autoclose:false,
        todayBtn:true,
        clearBtn:true
    });
    $(document).on('change','.status',function(){
        var status = $('.status option:selected').val();
        if(status == 'reject')
        {
            $('.reason').removeClass('hidden');
        }else{
            $('.reason').addClass('hidden');
        }
    });
    $(document).on('click','.save_and_continue',function(){
        var form_data = $('#product_form').serialize();
        $.ajax({
            url:"{{ route('Products.update' , encrypt($product->id)) }}",
            dataType:'json',
            type:'PUT',
            data:form_data,
            beforeSend: function(){
                $('.loading_save_and_continue').removeClass('hidden');

            },success: function(){
                $('.loading_save_and_continue').addClass('hidden');
            },error(){
                $('.loading_save_and_continue').addClass('hidden');
            }
        });
        return false;
    });
</script>
<script>
    var loadFile = function (event) {
        var img = document.getElementById('output');
        img.src = URL.createObjectURL(event.target.files[0]);
        output.img = function () {
            URL.revokeObjectURL(img.src)
        }
    };
</script>
<script type="text/javascript">
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
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initAutocomplete&language=ar
     async defer"></script>
@endsection
