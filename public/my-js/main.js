
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

// connect socket
try{
	let idCrurent = $('body').attr('id') ?  $('body').attr('id') : 0;
	console.log(idCrurent);
	conn = new WebSocket('ws://localhost:' + BROADCAST_PORT);
	conn.onopen = function(e) {
	    console.log("Connection established!");
	};
	conn.onmessage = function(e) {
		let info = JSON.parse(e.data);
		idCrurent = parseInt(idCrurent);
		if(info.to_id == idCrurent || info.from_id == idCrurent) {
			$.ajax({
			    url: base_url + 'chat/create_mesage',
			    type: 'POST',
			    data: {id_curent: idCrurent, msg: info},
			    success: function (result) {
			    	$('.msg_card_body').append(result);
			    	if(info.from_id == idCrurent) {
			    		$('.type_msg').val(' ');
			    	}			    	
			    }
			});
		}
		
	};
}catch (error) {
	console.log(error);
}


	//conn.send('hello');
function send_message(BROADCAST_URL, BROADCAST_PORT) {
	let msg = $('.type_msg').val();
	let idForm = $('body').attr('id') ?  parseInt($('body').attr('id')) : 0;
	let idTo = $('.type_msg').attr('id-to') ? parseInt($('.type_msg').attr('id-to')) : 0;

	let dataMsg = {
			msg: msg,
			from_id: idForm,
			to_id: idTo
	};	
	$.ajax({
	    url: base_url + 'chat/save_message',
	    type: 'POST',
	    data: dataMsg,
	    success: function (data) {
	    	let flag = parseInt(data);
	    	if(flag == 1) {
	    		var ws = new WebSocket('ws://localhost:' + BROADCAST_PORT);
	    		ws.onopen = () => conn.send(JSON.stringify(dataMsg));
	    	}
	    }
	});

}





