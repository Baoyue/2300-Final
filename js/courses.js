$(document).ready(function(){

	//takes care of tooltip animation
	$("#tooltip").hide();
	$('#notice').bind('click', function() {
		$('#tooltip').toggle();
	});   

	//takes care of courses click animation
	$(".hidden").hide();
	$('.class-titles').bind('click', function() {
		var index = $(this).index('.class-titles');
		$(".class-descrip").eq(index).toggle();
	});  
});