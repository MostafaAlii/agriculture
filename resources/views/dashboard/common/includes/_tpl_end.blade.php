<script src="{{ asset('assets/admin/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery-ui-1.13.1/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/treeview/treeview.js') }}"></script>

<script src="{{ asset('assets/admin/js/myFun/myFunction.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery.repeater.js') }}"></script>

<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/dataTables.buttons.min.js') }}"></script>

<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/admin/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/datatable/buttons.server-side.js') }}"></script>
<script src="{{ asset('assets/admin/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap-multiselect.min.js') }}"></script>


<!-- END: Page Vendor JS-->
<script src="{{ asset('assets/admin/vendors/js/forms/select/select2.full.min.js') }}"></script>
<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/admin/js/core/app-menu.js') }}"></script>
<script src="{{ asset('assets/admin/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/admin/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
<!-- END: Page JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('assets/admin/vendors/js/charts/chart.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/charts/apexcharts/apexcharts.min.js') }}"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Page JS-->
<script src="{{ asset('assets/admin/js/scripts/pages/material-app.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts/pages/dashboard-crypto.js') }}"></script>
<!-- END: Page JS-->
<script src="{{ asset('assets/admin/js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts/modal/components-modal.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/extensions/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/jstree/jstree.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/jstree/jstree.wholerow.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/admin/jstree/jstree.checkbox.js') }}" type="text/javascript"></script>
<!-- this for contact us page -->
<script src="{{ asset('assets/admin/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts/pages/app-email.js') }}"></script>
@toastr_js
@toastr_render
{{-- image preview --}}
<script>
    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
{{-- end image preview --}}
<script>
    $(function() {
        $('.datepiker').datepiker();
    })
</script>
{{-- test bulk delete 2 --}}
<script>
    $(function() {
        jQuery("[name=select_all]").click(function(source) {
            checkboxes = jQuery("[name=delete_select]");
            for (var i in checkboxes) {
                checkboxes[i].checked = source.target.checked;
            }
        });
    })
</script>


<script type="text/javascript">
    $(function() {
        $('#btn_delete_all').click(function() {
            var selected = [];
            $('.table #delete_select:checked').each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_select').modal('show')
                $('input[id="delete_select_id"]').val(selected);
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        //  ajax for get states data of area =====================================================================
        $('select[name="area_id"]').on('change', function() {
            var area_id = $(this).val();
            // console.log(province_id);
            if (area_id) {
                $.ajax({
                    url: "{{ URL::to('dashboard_admin/admin/state') }}/" + area_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="state_id"]').empty();
                        $('select[name="state_id"]').append( '<option selected disabled>--select--</option>');

                        $.each(data, function(key, value) {

                            $('select[name="state_id"]').append(
                                '<option value="' + key + '">' + value +'</option>'
                            );
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
{{-- test bulk delete 2 --}}
@yield('js')
{{-- @stack('js') --}}

</body>
<!-- END: Body-->

</html>
