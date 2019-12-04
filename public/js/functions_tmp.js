$( document ).ready(function() {
    $(".this_more").hover(function(){
        // $(".menu-expand-wrapper").animate({"display": "block", "opacity" : "1"});
        $(".menu-expand-wrapper").css({
		    "opacity":"1",
		    "display":"block",
		}).show().animate({opacity:1})
    }, function(){
    	// $(".menu-expand-wrapper").animate({"display": "block", "opacity" : "0"});
    	$(".menu-expand-wrapper").css({
		    "opacity":"0",
		    "display":"none",
		}).show().animate({opacity:0})
    });
});