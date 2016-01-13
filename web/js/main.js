/**
 * Created by Kdes70 on 24.11.2015.
 */

$(window).on('load', function (){


    $('.wow').hide();
    var $preloader = $('#page-preloader'),
        $spinner   = $preloader.find('.spinner');

    $spinner.fadeOut();
    $preloader.delay(350).fadeOut('slow', function(){

        $('.wow').show();


        wow = new WOW(
            {
                boxClass:     'wow',      // default
                animateClass: 'bounceInDown', // default
                offset:       0,          // default
                mobile:       true,       // default
                live:         false        // default
            }
        )
        wow.init();
    });


});

$(document).ready(function(){

    $('.toggle-menu').click(function(){
        $(this).toggleClass('on');
        $('.top-menu').slideToggle();
    });

    $('input[data-atr="icheck"]').iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square'
    });




});