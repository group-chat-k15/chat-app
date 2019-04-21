$(document).ready(function(){
	$('#action_menu_btn').click(function(){
		$('.action_menu').toggle();
	});
	
	$('.my-profile').click(() => {
		$('.my-profile-zone').toggleClass('active');
	});
});

showImage = (image) => {
	let src = $(image).attr('src');
	$('.show-image img').attr('src', src);
	$('.show-image').addClass('active');
}
 
$('.show-image').click(function() {
	$(this).removeClass('active');
})