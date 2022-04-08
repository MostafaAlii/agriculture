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
});