function showmeau(){
	$(".h_user").on("mouseenter",function(){
			$(this).find('ul').slideDown("fast");
		});
	
	$(".h_user").on("mouseleave",function(){
			$(this).find('ul').slideUp("fast");
		});
}

function init(){

	var animei=function(){
     var pwidth=$(".h_text").width();
	$(".h_float").animate({
   left:pwidth*0.5, 
   top:100,
   }, 15000);
	$(".h_float").animate({
   left: 0, 
   top:100,
   }, 10000);
	$(".h_float").animate({
   left: 0, 
   top:0,
   }, 5000);
    }
    animei();
    var timer=setInterval(animei,30000);

}