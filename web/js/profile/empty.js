$(document).ready(function(){


    $.dialogbox({
        type:'msg',
        title:'<div style="text-align:center;">Вы не прошли не одной категории</div>',
        content:'<div style="text-align: center;">Пожалуйста пройдите хотябы одну категорию </div>',
        btn:['ок'],
        call:[
            function(){
                $.dialogbox.close();
                location.href = Routing.generate('category');

            }
        ]
    });















});