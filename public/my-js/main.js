
// load broad mesage
$('.friend-box').click(function() {
	let idUser = $(this).attr('id-user');
	$.ajax({
	    url: base_url + 'chat/load_broad_message',
	    type: 'POST',
	    data: {id: idUser},
	    success: function (data) {
	    	console.log(data);        	 
	    }
	});
	$('.loading-message').removeClass('d-none')
});

