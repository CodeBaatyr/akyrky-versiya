$(document).ready(function(){
    var select_variant,suylom_id,category_id,tuura_variant_index,count;
    //убакыт башы
    var timer1=15,totalCount,counter;
    var check;
    var slug=true;
    counter=$("#counter").val();
    totalCount=$("#totalCount").val();
    var styleWidthValue=(((counter)*100)/totalCount),styleContent;
    function kanchaOttu(styleContent,styleWidthValue){

        $("#foto").attr('style',styleContent).text(counter+"/"+totalCount);
    }
    styleContent='width: '+styleWidthValue+'%;';
    kanchaOttu(styleContent,styleWidthValue);

    function timer() {
        if ($('input[name=noname]:checked').length==0)
            check2=true;
        else check2=false;


        if ($(".test__submit__one").data('clicked'))
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
                $(".test__submit__one").attr("disabled","disabled");
                $.dialogbox({
                    type:'msg',
                    title:'<div id="alertTitleTime">упс!!</div>',
                    content:'<div id="alertContentTime">Время вышло!</div>',
                    btn:['ok'],
                    call:[
                        function(){
                            $.dialogbox.close();
                            suylom_id=$('#suylom_id').val();
                            category_id=$('#category_id').val();
                            count=$('#count').val();
                            $.ajax({
                                type: "post",
                                data: "suylom_id=" + suylom_id + "&category_id=" + category_id + "&count=" + count,
                                dataType: "html",
                                url: Routing.generate('next_bolum__test'),
                                success: function (data) {

                                    if (data.substring(5, 7) != -1) {
                                        nextId = data.substring(5);
                                        counter++;
                                        location.href = Routing.generate('show_bolum__test', {
                                            cat_id: category_id,
                                            id: nextId,
                                            count: count,
                                            totalCount:totalCount,
                                            counter:counter
                                        });

                                    }
                                    else {
                                        titleMsg = data.substring(7, data.indexOf("|"));
                                        contentMsg = data.substring(data.indexOf("|") + 1,data.indexOf("."));
                                       // alert('ishtep '+data.substring(data.indexOf(".")+1));
                                        if (data.substring(data.indexOf(".")+1)!=0){
                                            categoryName=data.substring(data.indexOf(".")+1);
                                            //alert('if istedi');
                                            contentMsg+='<br><p style="color: #00a65a">вы открыли раздел <strong>'+categoryName+'</strong></p>';
                                           // alert('if istedi ayagy');
                                        }
                                      //  alert('ishtebey');
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








    //убакыт аягы












    $(".test__submit__one").click(function() {


        if($('input[name=noname]:checked').length==0){
            $.dialogbox({
                type:'msg',
                title:'Внимание',
                content:'Вы не выбрали пожалуйста выберите!',
                btn:['ok'],
                call:[
                    function(){
                        $.dialogbox.close();
                    }
                ]
            });
        }else {

            $(".test__submit__one").data('clicked',true);
            select_variant=$('input[name=noname]:checked').val();
            suylom_id=$('#suylom_id').val();
            category_id=$('#category_id').val();
            tuura_variant_index=$('#tuura_variant_index').val();
            count=$('#count').val();

            //alert(select_variant+' '+suylom_id+' '+category_id+' '+tuura_variant_index);
            $.ajax({
                type: "post",
                data: "select_variant=" +select_variant+ "&suylom_id=" + suylom_id+ "&category_id=" +  category_id+ "&tuura_variant_index="+tuura_variant_index,
                dataType: "text",
                url: Routing.generate('bolum__test_check_variant', { count: count }),
                success: function (data) {

                    if(data.indexOf("true")>-1){
                        success_sound();
                        count=data.substring(9);
                    // alert(data.indexOf("1"));

                        $(".bolum__test__footer").slideDown(400);
                        $(".checkmark").show()
                        $(".bolum__test__info").text("");
                        $(".bolum__test__true").text("Верно!").css({"color": "#65AB00", "font-size": "150%"});
                        $(".test__submit__one").attr("disabled", "disabled");
                        $(".bolum__test__footer").css({"background-color": "#BFF199"});
                        $(".bolum__test__check__btn__in").css({"background-color": "#65AB00", "color": "#FFFFFF"});
                        var id  = $("#butId").attr('href'),
                            top = $(id).offset().top;

                        $('body,html').animate({scrollTop: top}, 5000);






                    }else {
                        //alert(data.indexOf("|"));
                         error_sound();
                         count=data.substring(5,data.indexOf("|"));
                         trueVariant=data.substring(data.indexOf("|")+1);
                        $(".bolum__test__footer").slideDown(400).css({"background-color": "#FFD3D1"});
                        $(".close-button").show();
                        $(".bolum__test__info").text("Правильный ответ:").css({
                            "color": "#E70800",
                            "font-size": "150%"
                        });

                        $(".bolum__test__true").text(trueVariant).css({"color": "#E70800"});
                       $(".test__submit__one").attr("disabled", "disabled");
                        $(".bolum__test__check__btn__in").css({"background-color": "#E70800", "color": "#FFFFFF"});
                        var id  = $("#butId").attr('href'),
                            top = $(id).offset().top;

                        $('body,html').animate({scrollTop: top}, 5000);


                    }

                }

            });

        }


    });




    $(".bolum__test__check__btn__in").click(function () {

        // alert('count:'+count+' category_id '+category_id+' suylom_id '+suylom_id);
        $(".bolum__test__check__btn__in").attr("disabled", "disabled");
        $.ajax({
            type: "post",
            data: "suylom_id=" + suylom_id + "&category_id=" + category_id + "&count=" + count,
            dataType: "html",
            url: Routing.generate('next_bolum__test'),
            success: function (data) {

                if (data.substring(5, 7) != -1) {
                    nextId = data.substring(5);
                    counter++;
                    location.href = Routing.generate('show_bolum__test', {
                        cat_id: category_id,
                        id: nextId,
                        count: count,
                        totalCount:totalCount,
                        counter:counter
                    });

                }
                else {
                    titleMsg = data.substring(7, data.indexOf("|"));
                    contentMsg = data.substring(data.indexOf("|") + 1,data.indexOf("."));
                   // alert('ishtep '+data.substring(data.indexOf(".")+1));
                    if (data.substring(data.indexOf(".")+1)!=0){
                        categoryName=data.substring(data.indexOf(".")+1);
                       // alert('if istedi');
                        contentMsg+='<br><p style="color: #00a65a">вы открыли категорию <strong>'+categoryName+'</strong></p>';
                       // alert('if istedi ayagy');
                    }
                   // alert('ishtebey');
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


    });


});