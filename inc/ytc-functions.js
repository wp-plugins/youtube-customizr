(function ($) {

    if (typeof videos != 'undefined') {

        $(document).on('ready', function () {
            $(window).on('resize', function () {

                resizeYtPlayer(videos);

            }).trigger('resize')
        }).trigger('ready')

    }
    //Admin Read More
    $('.postbox .read-more').click(function () {
        $('.postbox .more-description').toggle();
        $('.postbox .read-more span').each(function() {
            $(this).toggle();
        });
    });

})(jQuery);