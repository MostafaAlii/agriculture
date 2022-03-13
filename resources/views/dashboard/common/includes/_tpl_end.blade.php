
        <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/admin/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    {{-- <script src="{{ asset('assets/admin/vendors/js/material-vendors.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->
    <script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/admin/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('assets/admin/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
    <!-- END: Page JS-->
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{ asset('assets/admin/vendors/js/charts/chart.min.js') }}"></script>
        <script src="{{ asset('assets/admin/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
        <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('assets/admin/js/scripts/pages/material-app.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}"></script>
    <!-- END: Page JS-->
    <script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js')}}"></script>
    <script src="{{ asset('assets/admin/js/scripts/modal/components-modal.js')}}"></script>
    @toastr_js
    @toastr_render
    {{-- <script src="{{ asset('assets/admin/noty/noty.min.js') }}"></script> --}}
    {{-- image preview --}}
    <script>
        $(".img").change(function(){
            if(this.files && this.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $(".img-preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    {{-- end image preview --}}
    @yield('js')

</body>
<!-- END: Body-->

</html>


