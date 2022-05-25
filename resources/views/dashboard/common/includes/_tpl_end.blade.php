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
{{-- test bulk delete 2 --}}
@yield('js')
{{-- @stack('js') --}}

</body>
<!-- END: Body-->

</html>
