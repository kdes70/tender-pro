/**
 * Created by Kdes70 on 24.11.2015.
 */
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