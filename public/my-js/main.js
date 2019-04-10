
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

//// connect socket
//try{
//	conn = new WebSocket('ws://localhost:' + BROADCAST_PORT);
////	conn.onopen = function(e) {
////	    console.log("Connection established!");
////	};
////	conn.onmessage = function(e) {
////		let info = JSON.parse(e.data);
////	    console.log(info);
////	};
//}catch (error) {
//	console.log(error);
//}
console.log(BROADCAST_PORT);
const socket = new WebSocket('ws://localhost:' + BROADCAST_PORT); // create websocket instance

socket.addEventListener('error', (event) => { /* do something */ });
// or the same
socket.onerror = (event) => { /* do something */ };

	//conn.send('hello');
function send_message(BROADCAST_URL, BROADCAST_PORT) {
	let msg = $('.type_msg').val();
	let idForm = $('body').attr('id') ?  $('body').attr('id') : 0;
	let idTo = $('.type_msg').attr('id-to') ? $('.type_msg').attr('id-to') : 0;

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





