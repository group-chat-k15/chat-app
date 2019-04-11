$(document).ready(function(){
	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});
	
	$('.my-profile').click(() => {
		$('.my-profile-zone').toggleClass('active');
	});
});