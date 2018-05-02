$(document).ready(function(){


    var select_soz;
    var category_id;
    var surot_menen_ishto_id;
    var timer1=15;
    var check;
    var slug=true,count,totalCount,counter;
    var go_down = jQuery('body');
    counter=$("#counter").val();
    totalCount=$("#totalCount").val();
    $('body,html').animate({scrollTop: 100});
    var styleWidthValue=(((counter)*100)/totalCount),styleContent;
    function kanchaOttu(styleContent,styleWidthValue){

         $("#foto").attr('style',styleContent).text(counter+"/"+totalCount);
         }
    styleContent='width: '+styleWidthValue+'%;';
    kanchaOttu(styleContent,styleWidthValue);


    $("#Go_Top").hide().removeAttr("href");
    if ($(window).scrollTop() >= "50") {

        $("#Go_Top").fadeIn("slow");

    }
    var scrollDiv = $("#Go_Top");
    $(window).scroll(function() {
        if ($(window).scrollTop() <= "50") {

            $(scrollDiv).fadeOut("slow");

        }
        else $(scrollDiv).fadeIn("slow")
    });
    $("#Go_Bottom").hide().removeAttr("href");
    if ($(window).scrollTop() <= go_down.height()+"1000")
    {

        $("#Go_Bottom").fadeIn("slow");

    }
    var scrollDiv_2 = $("#Go_Bottom");
    $(window).scroll(function() {
        if ($(window).scrollTop() >= go_down.height()+"1000") {

            $(scrollDiv_2).fadeOut("slow");

        }
        else $(scrollDiv_2).fadeIn("slow")
    });
    $("#Go_Top").click(function() {
        $("html, body").animate({scrollTop: 0}, "slow");
    })
    $("#Go_Bottom").click(function() {
        $("html, body").animate({scrollTop: go_down.height()+"1000"}, "slow");
    })



    function timer() {
        if ($('input[name=soz]:checked').length==0)
            check2=true;
        else check2=false;


        if ($(".foto__submit__one").data('clicked'))
            check=false;
        else  check=true;
        if((check2==false && check==true) || (check2==true && check==false) || (check2==true && check==true)   )
                ish=true;
        else ish =false;

        if(ish) {
            $("#timer").text('осталось времени:'+timer1);
            if (timer1<7) {
             if(slug){
                 $("#timer").css({"color":"red","font-size":"100%","transition":"1s"});
                 slug=false;
             }else{
                 $("#timer").css({"color":"red","font-size":"105%","transition":"1s"});
                 slug=true;
             }


            }
            if (timer1 == 0) {

                $("#timer").text('время истекло');
                $(".foto__submit__one").attr("disabled","disabled");
                $.dialogbox({
                    type:'msg',
                    title:'<div id="alertTitleTime">упс!!</div>',
                    content:'<div id="alertContentTime">Время вышло!</div>',
                    btn:['ok'],
                    call:[
                        function(){
                            $.dialogbox.close();
                            surot_menen_ishto_id = $('#surot_menen_ishto_id').text();
                            category_id = $('#category_id').text();
                            count=$("#count").val();
                            $.ajax({
                                type: "post",
                                data: "surot_menen_ishto_id=" + surot_menen_ishto_id + "&category_id=" + category_id,
                                dataType: "html",
                                url: Routing.generate('next',{count:count}),
                                success: function (data) {

                                    if (data.substring(5, 7) != -1) {

                                        count=$("#count").val();
                                        counter++;
                                        location.href = Routing.generate('bolum_foto', {cat_id: category_id, id: data,count:count,
                                            totalCount:totalCount,counter:counter});

                                    }
                                    else {
                                        count=$("#count").val();
                                        // alert("count block timer:"+count)
                                        titleMsg = data.substring(7, data.indexOf("|"));
                                        contentMsg = data.substring(data.indexOf("|") + 1,data.indexOf("."));
                                        if (data.substring(data.indexOf(".")+1)==1){
                                            contentMsg+='<br><p style="color: #00a65a">вы открыли раздел перевод</p>';
                                        }
                                        $.dialogbox({
                                            type: 'msg',
                                            title: '<div style="text-align: center; font-weight: bold;">'+titleMsg+'</div>',
                                            content: '<div style="text-align: center;  font-style: italic;margin-top: 0px;margin-bottom: 0px;">'+contentMsg+'</div>',
                                            btn: ['ok'],
                                            call: [
                                                function () {
                                                    $.dialogbox.close();
                                                    location.href = Routing.generate('bolum', {cat_id: category_id});
                                                }

                                            ]
                                        });


                                    }

                                }

                            });

                        }
                    ]
                });



            } else {

                timer1--;
                setTimeout(timer, 1000);

            }
        }


    }


    timer();


//текшеруу
    $(".foto__submit__one").click(function() {
        $(this).data('clicked', true);
        select_soz=$('input[name=soz]:checked').val();
        if($('input[name=soz]:checked').length==0){
            $.dialogbox({
                type:'msg',
                title:'Внимание',
                content:'Вы не выбрали пожалуйста выберите!',
                btn:['ok'],
                call:[
                    function(){
                        $.dialogbox.close();
                        $(".foto__submit__one").data('clicked',false);
                    }
                ]
            });
        }else {
               $(".foto__submit__one").attr("disabled","disabled");
                category_id = $('#category_id').text();
                surot_menen_ishto_id = $('#surot_menen_ishto_id').text();
                count=$("#count").val();
                $.ajax({
                    type: "post",
                    data: "select_soz=" + select_soz + "&category_id=" + category_id
                    + "&surot_menen_ishto_id=" + surot_menen_ishto_id,
                    dataType: "html",
                    url: Routing.generate('check_soz', { count: count }),
                    success: function (data) {

                        counter++;


                            if (data.indexOf("true")>-1) {
                                success_sound();

                                $(".bolum__foto__footer").show();
                                $(".bolum__foto__check").slideDown(400);
                                $(".bolum__foto__check__btn").slideDown(400);
                                $(".checkmark").show()
                                $(".bolum__foto__info").text("");
                                $(".bolum__foto__true").text("Верно!").css({"color":"#65AB00","font-size":"150%"});
                                $(".foto__submit__one").attr("disabled","disabled");
                                $(".bolum__foto__footer").css({"background-color":"#BFF199"});
                                $(".bolum__foto__check__btn__in").css({"background-color":"#65AB00","color":"#FFFFFF"});
                                count=data.substring(9);

                                var id  = $("#butId").attr('href'),
                                    top = $(id).offset().top;

                                $('body,html').animate({scrollTop: top}, 5000);




                            }
                            else {
                                error_sound();

                                $(".bolum__foto__footer").css({"background-color":"#FFD3D1"});
                                $(".bolum__foto__footer").show();
                                $(".close-button").show();
                                $(".bolum__foto__info").text("Правильный ответ:").css({"color":"#E70800","font-size":"150%"});
                                $(".bolum__foto__check").slideDown(400);
                                $(".bolum__foto__check__btn").slideDown(400);
                                trueVariant=data.substring(data.indexOf("|")+1);

                                $(".bolum__foto__true").text(trueVariant).css({"color":"#E70800"});
                                $(".foto__submit__one").attr("disabled","disabled");
                                $(".bolum__foto__check__btn__in").css({"background-color":"#E70800","color":"#FFFFFF"});
                                count=data.substring(5,data.indexOf("|"));


                                var id  = $("#butId").attr('href'),
                                    top = $(id).offset().top;

                                $('body,html').animate({scrollTop: top}, 5000);







                            }



                    }

                });

        }
    });
    //кийинкиге отуу
    $(".bolum__foto__check__btn__in").click(function() {
        $(".bolum__foto__check__btn__in").attr("disabled","disabled");
        surot_menen_ishto_id=$('#surot_menen_ishto_id').text();
        category_id=$('#category_id').text();
        $.ajax({
            type: "post",
            data: "surot_menen_ishto_id="+surot_menen_ishto_id+"&category_id="+category_id,
            dataType: "html",
            url:Routing.generate('next',{count:count}),
            success: function(data) {

                if (data.substring(5, 7) != -1)
                {



                    location.href = Routing.generate('bolum_foto', { cat_id: category_id, id: data ,
                        count:count,totalCount:totalCount,counter:counter});

                }
                else
                {
                    titleMsg = data.substring(7, data.indexOf("|"));
                    contentMsg = data.substring(data.indexOf("|") + 1,data.indexOf("."));
                    if (data.substring(data.indexOf(".")+1)==1){
                        contentMsg+='<br><p style="color: #00a65a">вы открыли раздел перевод</p>';
                    }
                    $.dialogbox({
                        type:'msg',
                        title:'<div style="text-align: center; font-weight: bold;">'+titleMsg+'</div>',
                        content:'<div style="text-align: center;  font-style: italic;margin-top: 0px;margin-bottom: 0px;">'+contentMsg+'</div>',
                        btn:['ok'],
                        call:[
                            function(){
                                $.dialogbox.close();
                                location.href = Routing.generate('bolum',{ cat_id: category_id});
                            }

                        ]
                    });


                }

            }

        });


    });



});