$(document).ready(function() {

    $("#profile").click(function() {
        $.ajax({
            type: "post",
            dataType: "html",
            url:Routing.generate('check_profile'),
            success: function(data) {

                if (data==true)
                {

                    location.href = Routing.generate('profile');


                }else {
                    $.dialogbox({
                        type:'msg',
                        title:'<div style="text-align:center;">Профиль сейчас не доступно</div>',
                        content:'<div style="text-align: center;">Пожалуйста пройдите хотя бы одну категорию</div>',
                        btn:['ок'],
                        call:[
                            function(){
                                $.dialogbox.close();


                            }
                        ]
                    });
                }


            }

        });


    });


});