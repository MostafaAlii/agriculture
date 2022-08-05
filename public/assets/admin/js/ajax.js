$(function () {
    //  استعلام بالاجاكس لجلب محافظات البلد ajax for provinces data of country ===============================
    $('select[name="country_id"]').on("change", function () {
        var country_id = $(this).val();
        // console.log(country_id);
        if (country_id) {
            $.ajax({
                url:
                    "{{ URL::to('dashboard_admin/admin/province') }}/" +
                    country_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="province_id"]').empty();
                    $('select[name="province_id"]').append(
                        "<option selected disabled>--select--</option>"
                    );

                    $.each(data, function (key, value) {
                        // console.log(data);
                        // console.log(key);
                        // console.log(value);
                        $('select[name="province_id"]').append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        } else {
            console.log("AJAX load did not work");
        }
    });

    //  ajax for area data of province =====================================================================
    $('select[name="province_id"]').on("change", function () {
        var province_id = $(this).val();
        // console.log(province_id);
        if (province_id) {
            $.ajax({
                url:
                    "{{ URL::to('dashboard_admin/admin/area') }}/" +
                    province_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="area_id"]').empty();
                    $('select[name="area_id"]').append(
                        "<option selected disabled>--select--</option>"
                    );

                    $.each(data, function (key, value) {
                        // console.log(data);
                        // console.log(key);
                        // console.log(value);
                        $('select[name="area_id"]').append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        } else {
            console.log("AJAX load did not work");
        }
    });

    //  ajax for get states data of area =====================================================================
    $('select[name="area_id"]').on("change", function () {
        var area_id = $(this).val();
        // console.log(province_id);
        if (area_id) {
            $.ajax({
                url: "{{ URL::to('dashboard_admin/admin/state') }}/" + area_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="state_id"]').empty();
                    $('select[name="state_id"]').append(
                        "<option selected disabled>--select--</option>"
                    );

                    $.each(data, function (key, value) {
                        // console.log(data);
                        // console.log(key);
                        // console.log(value);
                        $('select[name="state_id"]').append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        } else {
            console.log("AJAX load did not work");
        }
    });

    //  ajax for get villages data of state =====================================================================
    $('select[name="state_id"]').on("change", function () {
        var state_id = $(this).val();
        // console.log(province_id);
        if (state_id) {
            $.ajax({
                url:
                    "{{ URL::to('dashboard_admin/admin/village') }}/" +
                    state_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="village_id"]').empty();
                    $('select[name="village_id"]').append(
                        "<option selected disabled>--select--</option>"
                    );

                    $.each(data, function (key, value) {
                        // console.log(data);
                        // console.log(key);
                        // console.log(value);
                        $('select[name="village_id"]').append(
                            '<option value="' + key + '">' + value + "</option>"
                        );
                    });
                },
            });
        } else {
            console.log("AJAX load did not work");
        }
    });
}); //end of document ready
