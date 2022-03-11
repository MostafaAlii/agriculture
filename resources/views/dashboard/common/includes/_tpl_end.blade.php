
        <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('assets/admin/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('assets/admin/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    {{-- <script src="{{ asset('assets/admin/vendors/js/material-vendors.min.js') }}"></script> --}}
    <!-- END: Page Vendor JS-->




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
    {{-- <script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}"></script> --}}
    <!-- END: Page JS-->

    <script src="{{ asset('assets/admin/noty/noty.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            //delete
            $(document).on('click', '.delete', function (e) {
                var that = $(this)
                e.preventDefault();
                var n = new Noty({
                    text: "@lang('site.confirm_delete')",
                    type: "alert",
                    killer: true,
                    buttons: [
                        Noty.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
                            let url = that.closest('form').attr('action');
                            let data = new FormData(that.closest('form').get(0));
                            let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                            let originalText = that.html();
                            that.html(loadingText);
                            n.close();
                            $.ajax({
                                url: url,
                                data: data,
                                method: 'post',
                                processData: false,
                                contentType: false,
                                cache: false,
                                success: function (response) {
                                    $('.datatable').DataTable().ajax.reload();
                                    new Noty({
                                        layout: 'topRight',
                                        type: 'alert',
                                        text: response,
                                        killer: true,
                                        timeout: 2000,
                                    }).show();

                                    that.html(originalText);
                                },
                            });//end of ajax call
                        }),
                        Noty.button("@lang('site.no')", 'btn btn-danger mr-2', function () {
                            n.close();
                        })
                    ]
                });

                n.show();

            });//end of delete

        });//end of document ready
    </script>
    @yield('js')

</body>
<!-- END: Body-->

</html>


