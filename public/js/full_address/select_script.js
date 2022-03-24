 $(document).ready(function () {

     //---------------show all province of selected country------------------------//

    $('select[name="country_id"]').on('click', function () {

        var country_id = $(this).val();
        if(country_id==''){
            $('#province_id').empty();
          //  $('#province_id').append('<option disabled >-- اختر من القائمه --</option>');
        }

        $('#area_id').empty();
        $('#state_id').empty();
        $('#village_id').empty();
        
        $.ajax({
            type: "GET",
            //url: "{{ URL::to('fetch_provience')}}/" + country_id,
           
            url: "../../dashboard_admin/fetch_provience/" + country_id,
            dataType: "json",
            success: function (data)
            {
               // alert(data);
               $('#province_id').empty();
                if(data!='')
                { 
                    $.each(data, function (key, value) {
                        //alert('<option value="' + key + '">' + value + '</option>');
                    $('#province_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
                else
                {
                    $('#province_id').append('<option disabled لا يوجد مقاطعات للبلد المُختار</option>');
                }
                

            },
            error:function()
            { /*alert("false");*/ }
        });
    });

     //---------------show all area of selected provinece------------------------//

    $('select[name="province_id"]').on('click', function () {

        var province_id = $(this).val();
        if(province_id==''){
            $('#area_id').empty();
           // $('#area_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
        }

        $('#state_id').empty();
        $('#village_id').empty();
        
        $.ajax({
            type: "GET",
            //url: "{{ URL::to('fetch_area')}}/" + province_id,
           
            url: "../../dashboard_admin/fetch_area/" + province_id,
            dataType: "json",
            success: function (data)
            {
               // alert(data);

               $('#area_id').empty();
               
                if(data!='')
                {          
                    $.each(data, function (key, value) {
                        //alert('<option value="' + key + '">' + value + '</option>');
                    $('#area_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
                else
                {
                    $('#area_id').append('<option disabled> لا يوجد مناطق  للمقاطعه المُختاره</option>');
                }
                

            },
            error:function()
            { /*alert("false");*/ }
        });
    });

     //---------------show all state of selected area------------------------//

    $('select[name="area_id"]').on('click', function () {

        var area_id = $(this).val();
        if(area_id==''){
            $('#state_id').empty();
           // $('#state_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
        }

        $('#village_id').empty();
        $.ajax({
            type: "GET",
            //url: "{{ URL::to('fetch_state')}}/" + area_id,
           
            url: "../../dashboard_admin/fetch_state/" + area_id,
            dataType: "json",
            success: function (data)
            {
               // alert(data);
               $('#state_id').empty(); 
                if(data!='')
                {          
                    $.each(data, function (key, value) {
                        //alert('<option value="' + key + '">' + value + '</option>');
                    $('#state_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
                else
                {
                    $('#state_id').append('<option disabled> لا يوجد احياء  للمنطقه المُختاره</option>');
                }
                

            },
            error:function()
            { /*alert("false");*/ }
        });
    });

     //---------------show all village of selected state------------------------//

    $('select[name="state_id"]').on('click', function () {

        var state_id = $(this).val();
        if(state_id==''){
            $('#village_id').empty();
           // $('#village_id').append('<option value="" selected="true">-- اختر من القائمه --</option>');
        }

        $.ajax({
            type: "GET",
            //url: "{{ URL::to('fetch_village')}}/" + state_id,
           
            url: "../../dashboard_admin/fetch_village/" + state_id,
            dataType: "json",
            success: function (data)
            {
               // alert(data);
               $('#village_id').empty(); 
                if(data!='')
                {            
                    $.each(data, function (key, value) {
                        //alert('<option value="' + key + '">' + value + '</option>');
                    $('#village_id').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
                else
                {
                    $('#village_id').append('<option disabled> لا يوجد قرى  للحى المُختار</option>');
                }
                

            },
            error:function()
            { /*alert("false");*/ }
        });
    });





    
});