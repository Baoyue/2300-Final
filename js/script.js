// if document is loaded
$(document).ready(function(){

	// ----------NAVBAR----------

	// variables
	var current;
	var target;
	var travel;
	var time;

	$("#nav-index").click(function() {

		current = $(document).scrollTop();
		target = $(".section.index").offset().top;
		travel = Math.abs(target - current);
		time = travel / 2;

		$("html, body").animate( {
			scrollTop: target
		}, time);

		return false;
	});			

	$("#nav-add").click(function() {

		current = $(document).scrollTop();
		target = $(".section.add").offset().top;
		travel = Math.abs(target - current);
		time = travel / 2;

		$("html, body").animate( {
			scrollTop: target
		}, time);

		return false;
	});

	$("#nav-edit").click(function() {

		current = $(document).scrollTop();
		target = $(".section.edit").offset().top;
		travel = Math.abs(target - current);
		time = travel / 2;

		$("html, body").animate( {
			scrollTop: target
		}, time);

		return false;
	});


	$("#nav-albums").click(function() {

		current = $(document).scrollTop();
		target = $(".section.albums").offset().top;
		travel = Math.abs(target - current);
		time = travel / 2;

		$("html, body").animate( {
			scrollTop: target
		}, time);

		return false;
	});

	$("#nav-images").click(function() {
		
		current = $(document).scrollTop();
		target = $(".section.images").offset().top;
		travel = Math.abs(target - current);
		time = travel / 2;

		$("html, body").animate( {
			scrollTop: target
		}, time);

		return false;
	});

	// ----------NAVBAR DROPDOWN----------
	$('#nav-people-dropdown').hide();
	$('#nav-people').click(function() {
		$('#nav-people-dropdown').toggle();
	});

	$('#nav-events-dropdown').hide();
	$('#nav-events').click(function() {
		$('#nav-events-dropdown').toggle();
	});

	$('#nav-resources-dropdown').hide();
	$('#nav-resources').click(function() {
		$('#nav-resources-dropdown').toggle();
	});

	// ----------LOGIN MODAL----------
	$('.search').hide();
	$('#nav-search').click(function() {
		window.scrollTo(0,0);
		$('.search').slideToggle('slow', 'swing');
	});

	// ----------LOGIN MODAL----------
	$('.login').hide();
	$('#nav-login').click(function() {
		$('.login').show();
	});

	$('.x').click(function() {
		$('.login').hide();
	});

	// $('#nav-logout').click(function() {
	// 	window.location.href='../index.php';
	// });

	// $('#submit-login').click( function() {
	// 	return false;
	// });

	// ----------TOGGLE ALBUM'S IMAGES----------
	$('.toggle-wrapper.albums').hide();
	$('.thumbnail-wrapper.albums').click(function() {
		
		var self = this;
		var id = this.getAttribute('id');
		var idwrapper = id+'wrapper';
		
		$('.toggle-wrapper.albums:not(#'+idwrapper+')').hide();
		$('#'+idwrapper).slideToggle('slow','swing');
	});

	// ----------IMAGE DETAIL VIEW----------
	var this_id;
	var new_id;
	var desc_id;

	$(".overlay.images").hide();
	$(".thumbnail-modal").hide();
	$('.thumbnail:not(.albums)').click(function() {
		this_id = $(this).attr("id");
		new_id = '#detail_'+this_id.substring(4);
		desc_id = '#desc_'+this_id.substring(4);

		// console.log("clicking thumbnail");
		// console.log(this_id);
		// console.log(new_id);

		$(".overlay.images").show();
		$(new_id).show();
	});

	$(".overlay.images .x").click(function() {
		$(".overlay.images").hide();
		$(new_id).hide();
	});

	$(".tmb-mod-desc").hide();	
	$(".thumbnail-modal").hover(function() {
		this_id = $(this).attr("id");
		desc_id = '#desc_'+this_id.substring(7);
		$(desc_id).slideToggle(200, "swing");
		
		// console.log("hovering");
		// console.log(this_id);
		// console.log(desc_id);
	});

	// ----------ALERT BEFORE DELETION----------
	$('#delete-image').click(function() {
		alert ("Are you sure you want to delete an image?");
	});
	$('#delete-image').click(function() {
		alert ("Are you sure you want to delete an album?");
	})

});