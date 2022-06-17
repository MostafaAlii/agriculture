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
<script src="{{ asset('assets/admin/vendors/js/extensions/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/scripts/forms/wizard-steps.js') }}"></script>
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
{{-- Start Switchery --}}
<script type="text/javascript">
    $(function (){
        // Switchery Check Box ::
        var elem = document.querySelector('.js-switch');
        var init = new Switchery(elem,{
            color             : '#64bd63',
            secondaryColor    : '#ccc',
            jackColor         : '#fff',
            jackSecondaryColor: null,
            className         : 'switchery',
            disabled          : false,
            disabledOpacity   : 0.5,
            speed             : '1s',
            size              : 'small',
        });
    });
</script>
{{-- End Switchery --}}
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
            $("input:checkbox[name=delete_select]:checked").each(function() {
                selected.push($(this).val());
            });
            // $('.table #delete_select:checked').each(function() {
            //     selected.push(this.value);
            // });
            console.log(selected);
            console.log(selected.length);
            if (selected.length > 0) {
                $('#bulkdeleteall').modal('show');
                $('input[id="delete_select_id"]').val(selected);
            }else{
                // alert('Please select at least one record');
                toastr.error('الرجاء اختيار على الاقل عنصر واحد');
                // toastr.error(@lang('Admin/site.please_select_at_least_one_record'));
                // if(app()->getLocale() == 'ar'){
                //     toastr.error('الرجاء اختيار على الاقل عنصر واحد');
                //     alert(trans('Admin/site.please_select_at_least_one_record'));
                // }else{
                //     toastr.error('Please select at least one record');
                // }
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

<script>
    $(document).ready(function() {
        //  ajax for get villages data of state =====================================================================
        $('select[name="state_id"]').on('change', function() {
            var state_id = $(this).val();
            // console.log(province_id);
            if (state_id) {
                $.ajax({
                    url: "{{ URL::to('dashboard_admin/admin/village') }}/" + state_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="village_id"]').empty();
                        $('select[name="village_id"]').append( '<option selected disabled>--select--</option>');

                        $.each(data, function(key, value) {
                            // console.log(data);
                            // console.log(key);
                            // console.log(value);
                            $('select[name="village_id"]').append(
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

{{-- <script>
        window.oncontextmenu = function () {
        return false;
    };

    document.addEventListener("keydown", function(event){
        var key = event.key || event.keyCode;

        if (key == 123) {
            return false;
        } else if ((event.ctrlKey && event.shiftKey && key == 73) || (event.ctrlKey && event.shiftKey && key == 74)) {
            return false;
        }
    }, false);
</script> --}}
{{-- test bulk delete 2 --}}
@yield('js')
{{-- @stack('js') --}}

</body>
<!-- END: Body-->

</html>
