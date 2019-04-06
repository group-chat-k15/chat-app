
// load broad mesage
$('.friend-box').click(function() {
	let idUser = $(this).attr('id-user');
	$.ajax({
	    url: base_url + 'product/watch',
	    type: 'POST',
	    data: {id: id},
	    success: function (data) {
	    	 $("#watch").html(data);        	 
	    }
	});
	$('.loading-message').removeClass('d-none')
});

