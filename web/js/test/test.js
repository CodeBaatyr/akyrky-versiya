$(document).ready(function(){
    var go_down = jQuery('body');
    $("#Go_Top").hide().removeAttr("href");
    if ($(window).scrollTop() >= "250") $("#Go_Top").fadeIn("slow")
    var scrollDiv = $("#Go_Top");
    $(window).scroll(function() {
        if ($(window).scrollTop() <= "250") $(scrollDiv).fadeOut("slow")
        else $(scrollDiv).fadeIn("slow")
    });
    $("#Go_Bottom").hide().removeAttr("href");
    if ($(window).scrollTop() <= go_down.height()-"100") $("#Go_Bottom").fadeIn("slow")
    var scrollDiv_2 = $("#Go_Bottom");
    $(window).scroll(function() {
        if ($(window).scrollTop() >= go_down.height()-"100") $(scrollDiv_2).fadeOut("slow")
        else $(scrollDiv_2).fadeIn("slow")
    });
    $("#Go_Top").click(function() {
        $("html, body").animate({scrollTop: 0}, "slow")
    })
    $("#Go_Bottom").click(function() {
        $("html, body").animate({scrollTop: go_down.height()}, "slow")
    })

    $("#menu").on("click","a", function (event) {
        alert('salam');

        //отменяем стандартную обработку нажатия по ссылке





        //забираем идентификатор бока с атрибута href

        var id  = $("#link").attr('href'),




        //узнаем высоту от начала страницы до блока на который ссылается якорь

        top = $(id).offset().top;


        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);

    });
});