
// load broad mesage
$('.friend-box').click(function() {
	let idUser = $(this).attr('id-user');
	let idUserFirst = $(this).attr('active');
	if(idUserFirst == undefined) {
		$.ajax({
		    url: base_url + 'chat/load_broad_message',
		    type: 'POST',
		    data: {id: idUser},
		    beforeSend: function() {
		    	$('.loading-message').removeClass('d-none');
		    },
		    success: function (data) {
		    	setTimeout(function(){
		    		$('.block-message').html(data); 
		    		$('.loading-message').addClass('d-none');
		    	}, 50); 	 
		    }
		});
	}	
});

var conn = new WebSocket('ws://localhost:' + BROADCAST_PORT);
	conn.onopen = function(e) {
	    console.log("Connection established!");
	};
	conn.onmessage = function(e) {
	    console.log(e.data);
	};
	//conn.send('hello');
function send_message(BROADCAST_URL, BROADCAST_PORT) {
	let msg = $('.type_msg').val();
	let idForm = $('.type_msg').attr('id-form') ? $('.type_msg').attr('id-form') : 0;
	let idTo = $('.type_msg').attr('id-to') ?  $('.type_msg').attr('id-to') : 0;

	let data = {
			msg: msg,
			id_form: idForm,
			id_to: idTo
		};
	//console.log(data);
	//JSON.stringify(obj);
	var ws = new WebSocket('ws://localhost:' + BROADCAST_PORT);
	ws.onopen = () => conn.send(JSON.stringify(data));
	

}





