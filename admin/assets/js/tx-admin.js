jQuery(function ($) {

    //TODO change selector if plugin name changed #deactivate-elementor-addon
    
    $(document).on('click', '#deactivate-element-spark', function (e) {
        e.preventDefault();
        $('.tx-modal').addClass('show');
    });

    $(document).on('click', '.tx-modal', function (e) {
        if (!$('.tx-center').is(e.target) && $('.tx-center').has(e.target).length === 0){
            $('.tx-modal').removeClass('show');
        }
    });

    $(document).on('click', '.tx-lightbox-skip,.tx-lightbox-submit', function (e) {

        if ( $(e.target).hasClass('tx-lightbox-submit') ){
            var cause = $('input[name="tx_reason"]:checked').val();;
        } else {
            var cause = '';
        }

        data = {
            'action': 'es_deactivate_plugin',
            'cause' : cause,
        };

        $.ajax({
            url: ajaxurl,
            data: data,
            type: 'POST',
            success: function (data) {
                location.reload();
            },

        });

    });

});