$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if (scroll > 10){
        $('nav').css('background-color','black');
        $('nav').css('background-size','cover');
        $('nav').css('background-position','center');
        $('nav').css('background-repeat','no-repeat');
        $('nav').css('background-attachment','fixed');
    }else{
    	if (scroll < 600){
    		$('nav').css('background-color','rgba(255,255,255,0)');
        	$('nav').css('border-bottom-right-radius','25px');
       	}
    }
});