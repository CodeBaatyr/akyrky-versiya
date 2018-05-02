$(document).ready(function(){
    var login;
    var password;
    var email;
    function getlogin() {
        login= $("#reg_login_les").val();

    }
    function getpassword() {
        password= $("#reg_password_les").val();

    }
    function getemail() {
        email= $("#reg_email_les").val();

    }
    $("#form_submit").click(function(){
        getlogin();
        getpassword();
        getemail();
    });

    $('#form_reg').validate(
        {

            rules:{
                "reg_login_les":{
                    required:true,
                    minlength:5,
                    maxlength:15,
                    remote: {
                        type: "post",
                        url: Routing.generate('check_login')
                    }
                },
                "reg_password_les":{
                    required:true,
                    minlength:7,
                    maxlength:15


                },
                "reg_email_les":{
                    required:true,
                    email:true,
                    remote: {
                        type: "post",
                        url: Routing.generate('check_email')
                    }
                }
            },


            messages:{
                "reg_login_les":{
                    required:"Укажите Логин!",
                    minlength:"От 5 до 15 символов!",
                    maxlength:"От 5 до 15 символов!",
                    remote: "Логин занят!"
                },
                "reg_password_les":{
                    required:"Укажите Пароль!",
                    minlength:"От 7 до 15 символов!",
                    maxlength:"От 7 до 15 символов!"

                },

                "reg_email_les":{
                    required:"Укажите свой E-mail",
                    email:"Не корректный E-mail",
                    remote: "Почта занять!"
                }
            },

            submitHandler: function(form){
                $.ajax({
                    type: "post",
                    data: "login="+login+"&password="+password+"&email="+email,
                    dataType:   'json',
                    url:Routing.generate('reg'),
                    success: function(data,status) {




                                $("#reg_login_les").val('');
                                $("#reg_password_les").val('');
                                $("#reg_email_les").val('');

                            $.dialogbox({
                                type:'msg',
                                title:'<div style="text-align:center;">поздравляем</div>',
                                content:'<div style="text-align: center;">вы успешно зарегистрировались!</div>',
                                btn:['ok'],
                                call:[
                                    function(){
                                        $.dialogbox.close();
                                        var student = data[0];
                                        $.ajax({
                                            type: "post",
                                            data: "login_email="+student['login']+"&password="+student['pasword'],
                                            dataType: "html",
                                            url:Routing.generate('vhod'),
                                            success: function(data) {

                                                if (data ==1)
                                                {

                                                    location.href = Routing.generate('category');

                                                }else {
                                                    alert('error registration!');
                                                }


                                            }

                                        });
                                    }
                                ]
                            });





                    },
                    error : function(xhr, textStatus, errorThrown) {
                        alert('Ajax request is failed ');
                    }
                });
            }
        });









});