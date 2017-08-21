$(document).ready(function() {
	$(".guess_box").click( checkForCode );

	$(".guess_box").hover(
		function() {
			$(this).addClass('my_hover');
		},
		function() {
			$(this).removeClass('my_hover');
		}
	);
		function checkForCode() {
			var discount;
			if($.contains(this, document.getElementById("has_discount"))) {
				discount = "<p>Your Code: " + getRandom(100) + "</p>";
			}
			else {
				discount = "<p>Sorry, no discount this time!</p>";

			}
			$('.guess_box').each(function(){
				if($.contains(this, document.getElementById("has_discount")))
					$(this).addClass('discount');
				else $(this).addClass('no_discount');
				$(this).unbind('click');
			});

			$('#result').append(discount);

		}

		var hideCode = function() {
			var numRand = getRandom(4);
			$(".guess_box").each(function(index, value) {
				if(numRand == index){
					$(this).append("<span id='has_discount'></span>");
					alert("you have discount at: " + (index) );
					return false;
				}
			});
		}

	hideCode();
});

function getRandom(num) {
	var my_num = Math.floor(Math.random()*num);
	return my_num;
}



