$(function () {
    'use strict';
    // Pusher Test Event ::
    Pusher.logToConsole = true;
    var pusher = new Pusher('8e20474632144230bbf3', {
        cluster: 'mt1'
    });
    var channel = pusher.subscribe('my-channel');
        channel.bind('App\\Events\\Dashboard\\MyEvent', function(data) {
        alert(JSON.stringify(data));
    });
    // ProductCouponIndex ::
    $('#code').keyup(function () {
        this.value = this.value.toUpperCase();
    });
    $('#start_date').pickadate({
        weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        format: 'yyyy-mm-dd',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: true, // Creates a dropdown to control month
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close after selecting a date,
    });
    var startdate = $('#start_date').pickadate('picker');
    var enddate = $('#expire_date').pickadate('picker');
    $('#start_date').change(function() {
        selected_ci_date ="";
        selected_ci_date = $('#start_date').val();
        if (selected_ci_date != null)   {
            var cidate = new Date(selected_ci_date);
            min_codate = "";
            min_codate = new Date();
            min_codate.setDate(cidate.getDate()+1);
            enddate.set('min', min_codate);
        }
    });
    $('#expire_date').pickadate({
        format: 'yyyy-mm-dd',
        min : new Date(),
        selectMonths: true, // Creates a dropdown to control month
        selectYears: true, // Creates a dropdown to control month
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });
});