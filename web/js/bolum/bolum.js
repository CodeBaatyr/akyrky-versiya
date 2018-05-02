$(document).ready(function(){
    var activeSatus;
    function active(){


        activeSatus=$("#active").text();
        if (activeSatus==1) {
            $(".lesson__foto_one").css({"filter": "grayscale(0)"});
            $(".bolum__suylom").attr("href", "#");
            $(".bolum__test").attr("href", "#");
        }
       else if (activeSatus==2) {


            $(".lesson__foto_one").css({"filter":"grayscale(0)"});
            $(".lesson__foto_two").css({"filter":"grayscale(0)"});
            $(".bolum__test").attr("href", "#");
        }
        else {
            $(".lesson__foto_one").css({"filter":"grayscale(0)"});
            $(".lesson__foto_two").css({"filter":"grayscale(0)"})
            $(".lesson__foto_three").css({"filter":"grayscale(0)"});

        }

    }

    active();



});