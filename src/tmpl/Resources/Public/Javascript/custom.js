$(document).ready(function(){

    /**** SCROLL MENU FIXED ****/
//    var positionMenu = $navigation.offset().top;
//    console.log(positionMenu);
//    $(window).scroll(function(e){
//        var st = $(this).scrollTop();
//        if($(window).scrollTop() > positionMenu){
//            $('body').addClass('scrolled');
//        }
//        else{
//            $('body').removeClass('scrolled');
//        }
//    });
    /**** FIN SCROLL MENU FIXED ****/

});

// Scroll down function
$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    //>=, not <=
    if (scroll >= 500) {
        //clearHeader, not clearheader - caps H
        $("body").addClass("scrolled");
    }
});