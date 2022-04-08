    <script src="{{ asset('assets/admin/js/jquery-3.6.0-jquery.min.js')}}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="{{ asset('assets/admin/js/myFun/myFunction.js')}}"></script>
    <script src="{{ asset('assets/admin/js/jquery.repeater.js')}}"></script>

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
    <script src="{{ asset('assets/admin/vendors/js/extensions/dropzone.min.js') }}"></script>
    <script src="{{asset('assets/admin/vendors/js/forms/toggle/switchery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/jstree/jstree.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/jstree/jstree.wholerow.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/jstree/jstree.checkbox.js')}}" type="text/javascript"></script>
     @toastr_js
    @toastr_render
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

        {{-- test bulk delete --}}
        {{-- <script>
            $(document).ready(function () {
                //delete
                $(document).on('click','.delete,#bulk-delete', function (e) {
                    var that = $(this)
                    // alert('hi');
                    e.preventDefault();
                    var n = new Noty({
                        text: "@lang('Admin/site.warning')",
                        type: "alert",
                        killer: true,
                        buttons: [
                            Noty.button("@lang('Admin/site.yes')", 'btn btn-success mr-2', function () {
                                let url = that.closest('form').attr('action');
                                // console.log(url);
                                let data = new FormData(that.closest('form').get(0));
                                // let data = 10;
                                console.log(data);
                                let loadingText = '<i class="fa fa-circle-o-notch "></i>';
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
                                        $("#record__select-all").prop("checked", false);
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

                            Noty.button("@lang('Admin/site.no')", 'btn btn-danger mr-2', function () {
                                n.close();
                            })
                        ]
                    });

                    n.show();

                });//end of delete

            });//end of document ready

            // CKEDITOR.config.language = "{{ app()->getLocale() }}";

            // //select 2
            // $('.select2').select2({
            //     'width': '100%',
            // });

        </script> --}}
        {{-- test bulk delete --}}


      {{-- test bulk delete 2 --}}
    <script>
        $(function(){
            jQuery("[name=select_all]").click(function(source){
                checkboxes = jQuery("[name=delete_select]");
                for(var i in checkboxes){
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>
    <script type="text/javascript">
        $(function(){
           $('#btn_delete_all').click(function(){
               var selected = [];
            //    $('.table input[name=delete_select]:checked').each(function(){
               $('.table #delete_select:checked').each(function(){
                   selected.push(this.value);
                });
                // console.log(selected);
               if(selected.length > 0){
                //    $('#btn_delete_all').attr('disabled', false)
                   $('#delete_select').modal('show')
                   $('input[id="delete_select_id"]').val(selected);
                }
                // else{
                //    $('#btn_delete_all').attr('disabled', true)
                //  }
           });
        });
    </script>
      {{-- test bulk delete 2 --}}
    @yield('js')
    {{-- @stack('js') --}}

</body>
<!-- END: Body-->

</html>


