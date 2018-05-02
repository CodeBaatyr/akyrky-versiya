$(document).ready(function(){
    var category_id ;
    var suylom_id,count,totalCount,counter;
    var go_down = jQuery('body');
    counter=$("#counter").val();
    totalCount=$("#totalCount").val();
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

    $(".suylom__submit__one").click(function() {
        var input_suylom = $('.suylom__area').val();//киргизген суйлом
        //бир нерсе кирсе
        if (input_suylom.replace(/\s+/g, '').length) {// бир нерсе киргизсе
            input_suylom=input_suylom.replace(/\,+/g, ' ');
            var is_kyr=input_suylom.replace(/\s+/g, '');

            if(is_kyr.match(/(^[а-яА-ЯёЁ0-9\.\?\!]+)$/)){//кирилица киргизсе
                suylom_id = $('#suylom_id').val();
                count=$("#count").val()
            $.ajax({
                type: "post",
                data: "input_suylom=" + input_suylom + "&suylom_id=" + suylom_id,
                dataType: "html",
                url: Routing.generate('check_suylom',{countTrue:count}),
                success: function (data) {

                    if (data.indexOf("true")>-1) {
                        count=data.substring(9);
                        //alert('count++:'+count);
                        success_sound();
                        $(".bolum__suylom__footer").slideDown(400);
                        $(".checkmark").show()
                        $(".bolum__suylom__info").text("");
                        $(".bolum__suylom__true").text("Верно!").css({"color": "#65AB00", "font-size": "150%"});
                        $(".suylom__submit__one").attr("disabled", "disabled");
                        $(".bolum__suylom__footer").css({"background-color": "#BFF199"});
                        $(".bolum__suylom__check__btn__in").css({"background-color": "#65AB00", "color": "#FFFFFF"});
                        var id  = $("#butId").attr('href'),
                            top = $(id).offset().top;

                        $('body,html').animate({scrollTop: top}, 5000);


                    }
                    else {


                        error_sound();
                        count=data.substring(5,data.indexOf("|"));
                        trueVariant=data.substring(data.indexOf("|")+1);
                       // alert('count:'+count);
                        $(".bolum__suylom__footer").slideDown(400).css({"background-color": "#FFD3D1"});
                        $(".close-button").show();
                        $(".bolum__suylom__info").text("Правильный ответ:").css({
                            "color": "#E70800",
                            "font-size": "150%"
                        });

                        $(".bolum__suylom__true").text(trueVariant).css({"color": "#E70800"});
                        $(".suylom__submit__one").attr("disabled", "disabled");
                        $(".bolum__suylom__check__btn__in").css({"background-color": "#E70800", "color": "#FFFFFF"});
                        var id  = $("#butId").attr('href'),
                            top = $(id).offset().top;

                        $('body,html').animate({scrollTop: top}, 5000);


                    }

                }

            });
        }else{
              $.dialogbox({
                    type:'msg',
                    title:'<div style="text-align: center">Внимание</div>',
                    content:'<div style="text-align: center">Введите кириллицу!</div>',
                    btn:['ok'],
                    call:[
                        function(){
                            $.dialogbox.close();
                            $('.suylom__area').val('');
                            input_suylom=input_suylom.replace(/\,+/g, ' ');
                            input_suylom=input_suylom.trim();
                            var is_kyr=input_suylom.split(/\s+/g);
                            var temp;
                            for (i=0;i<is_kyr.length;i++){
                                temp=is_kyr[i];
                            for (j=0;j<temp.length;j++){
                                if(!temp[j].match(/(^[а-яА-ЯёЁ0-9\.\?\!]+)$/)) {

                                    $('.suylom__area').val($('.suylom__area').val() +'');

                                }else
                                    $('.suylom__area').val($('.suylom__area').val() + temp[j]);

                            }
                                $('.suylom__area').val($('.suylom__area').val() + '   ');

                        }
                    }

                    ]
                });


            }
            }


        else  $.dialogbox({
            type:'msg',
            title:'<div style="text-align: center">Внимание</div>',
            content:'<div style="text-align: center"> Введите текст!</div>',
            btn:['ok'],
            call:[
                function(){
                    $.dialogbox.close();
                }
            ]
        });

    });

    $(".bolum__suylom__check__btn__in").click(function() {
        suylom_id=$('#suylom_id').val();
        category_id=$('#category_id').val();

        $.ajax({
            type: "post",
            data: "suylom_id="+suylom_id+"&category_id="+category_id,
            dataType: "html",
            url:Routing.generate('next_suylom',{countTrue:count}),
            success: function(data) {

                if (data.substring(5, 7) != -1)
                {
                    counter++;
                    location.href = Routing.generate('show_suylom', { cat_id: category_id, id: data,count:count
                        ,totalCount:totalCount,counter:counter});

                }
                else
                {  titleMsg = data.substring(7, data.indexOf("|"));
                    contentMsg = data.substring(data.indexOf("|") + 1,data.indexOf("."));
                    if (data.substring(data.indexOf(".")+1)==1){
                        contentMsg+='<br><p style="color: #00a65a">вы открыли раздел тест</p>';
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