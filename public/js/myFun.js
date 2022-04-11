$(function () {
    'use strict';
    $('[data-toggle="product_rating"]').on('change', function () {
        $.post('/user/ratings/product', {
            product_id: $(this).data('id'),
            rating: $(this).val(),
            _token: "{{ csrf_token() }}"
        }, function(response) {
            alert(response.rating)
        })
    });
});