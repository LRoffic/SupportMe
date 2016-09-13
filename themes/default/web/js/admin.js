$(".nodisplay").show();

$("#search").keyup(function(){
	var str = $("#search").val();
	$(".plugins").each(function(index){
		if($(this).attr("data-name")){
			if(!$(this).attr("data-name").match(new RegExp(str, "i"))){
				$(this).fadeOut("fast");
			}else{
				$(this).fadeIn("slow");
			}
		}
	});
});