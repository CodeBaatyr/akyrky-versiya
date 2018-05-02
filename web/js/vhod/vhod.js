$(document).ready(function(){
    $("#button-auth").click(function() {

        var login_email= $("#reg_login").val();
        var password= $("#reg_password").val();

        if (login_email == "" || login_email.length > 30 )
        {
            $("#reg_login").attr('placeholder','Введите пароль или почту').css({"borderColor" : "#FDB6B6","color":"#FDB6B6"});
            send_login = 'no';
        }else {

            $("#reg_login").css({"borderColor":"#DBDBDB","color":"#DBDBDB"});
            send_login = 'yes';
        }


        if (password == "" || password.length > 15 )
        {
            $("#reg_password").attr('placeholder','Введите пароль').css({"borderColor" : "#FDB6B6","color":"#FDB6B6"});
            send_pass = 'no';
        }else { $("#reg_password").css({"borderColor":"#DBDBDB","color":"#DBDBDB"});  send_pass = 'yes'; }

        if ( send_login == 'yes' && send_pass == 'yes' )
        {
            $("#button-auth").hide();
            $(".auth-loading").show();


            $.ajax({
                type: "post",
                data: "login_email="+login_email+"&password="+password,
                dataType: "html",
                url:Routing.generate('vhod'),
                success: function(data) {

                    if (data ==1)
                    {
                        $("#button-auth").show();
                        $(".auth-loading").hide();
                         location.href = Routing.generate('category');

                    }
                    else
                        {

                            $("#message-auth").slideDown(400);
                            $("#reg_login").css({"borderColor" : "#000000","color":"#ADADAD"});
                            $("#reg_password").css({"borderColor" : "#000000","color":"#ADADAD"});
                            $(".auth-loading").hide();
                            $("#button-auth").show();

                        }

                    }

            });


        }











    });

    $("#button-auth-adap").click(function() {

        var login_email= $("#reg_login_adap").val();
        var password= $("#reg_password_adap").val();

        if (login_email == "" || login_email.length > 30 )
        {
            $("#reg_login_adap").attr('placeholder','Введите пароль или почту').css({"borderColor" : "#FDB6B6","color":"#FDB6B6"});
            send_login = 'no';
        }else {

            $("#reg_login_adap").css({"borderColor":"#DBDBDB","color":"#DBDBDB"});
            send_login = 'yes';
        }


        if (password == "" || password.length > 15 )
        {
            $("#reg_password_adap").attr('placeholder','Введите пароль').css({"borderColor" : "#FDB6B6","color":"#FDB6B6"});
            send_pass = 'no';
        }else { $("#reg_password_adap").css({"borderColor":"#DBDBDB","color":"#DBDBDB"});  send_pass = 'yes'; }

        if ( send_login == 'yes' && send_pass == 'yes' )
        {
            $("#button-auth-adap").hide();
            $(".auth-loading").show();


            $.ajax({
                type: "post",
                data: "login_email="+login_email+"&password="+password,
                dataType: "html",
                url:Routing.generate('vhod'),
                success: function(data) {

                    if (data ==1)
                    {
                        $("#button-auth-adap").show();
                        $(".auth-loading").hide();
                        location.href = Routing.generate('category');

                    }
                    else
                    {

                        $("#message-auth-adap").slideDown(400);
                        $("#reg_login_adap").css({"borderColor" : "#000000","color":"#ADADAD"});
                        $("#reg_password_adap").css({"borderColor" : "#000000","color":"#ADADAD"});
                        $(".auth-loading").hide();
                        $("#button-auth-adap").show();

                    }

                }

            });


        }











    });




});