$(document).ready(function () {

    //Показать скрыть Фильтр
    $('.top_block .btn_filter').click(function () {
        console.log('click .btn_filter');
        $('.filter_block').slideToggle(300);
    });




    $('#hide_sidebar').click(function () {
        if ($('.sidebar').css('opacity') == 1) {
            $('.sidebar').css('width','0');
            $('.sidebar').css('opacity','0');
            $('.wrap').css('margin','50px 0 0 0');
        } else {
            $('.sidebar').css('width','200px');
            $('.sidebar').css('opacity','1');
            $('.wrap').css('margin','50px 0 0 200px');
        }

        //$('.sidebar').animate({width: 'toggle'});

    });


    $('.categorys_table .item').click(function () {
        if ($(this).hasClass('active')){
            $(this).removeClass('active');
        }else {
            $(this).addClass('active');
        }
    });

});