var KLIPAA = {};

    //----------------------------------------------------/
    // Predefined Variables
    //----------------------------------------------------/
    var $window = $(window),
        $document = $(document),
        $body = $('body'),
        // $sidebar = $('.fixed-sidebar'),
        $preloader = $('#hellopreloader');

    /* -----------------------
     * Preloader
     * --------------------- */

    KLIPAA.preloader = function () {
        $window.scrollTop(0);
        setTimeout(function () {
            $preloader.fadeOut(800);
        }, 500);
        return false;
    };