$(document).ready(function() {
    $('.menu-trigger').click(function() {
        $('nav ul').slideToggle(500);
    });//end slide toggle

    $(window).resize(function() {
        if (  $(window).width() > 640 ) {
            $('nav ul').removeAttr('style');
        }
    });//end resize
});//end ready