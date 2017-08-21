$(document).ready(function(){
	var v = false;

	$("button#vegOn").click(function() {
		if(v == false) {
			$f = $("li.fish").parent().parent().detach();
			$("li.hamburger").replaceWith('<li class="portobello"><em>Portobello Mushroom</em></li>');
			$(".portobello").parent().parent().addClass('veg_leaf');
			$("li.meat").after("<li class='tofu'><em>Tofu</em></li>");
			$(".tofu").parent().parent().addClass('veg_leaf');
			$m = $("li.meat").detach();

			v = true;
		}
	});

	$("button#restoreMe").click(function() {
		if(v == true) {
			v = false;
			$(".menu_entrees li").first().before($f);
			$(".portobello").parent().parent().removeClass('veg_leaf');
			$("li.portobello").replaceWith('<li class="hamburger">Hamburger</li>');
			$(".tofu").parent().parent().removeClass('veg_leaf');
			$(".tofu").each(function(i){
				$(this).after($m[i]);
			});
			$(".tofu").remove();
		}
	}); //버튼 끝





});//end doc ready
