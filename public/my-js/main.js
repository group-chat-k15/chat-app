

// serch friend
$('.search_btn').click(function() {
	$('#form-search').submit();
});

// load broad mesage
$('.friend-box').click(function() {
	let idUser = $(this).attr('id-user') ? parseInt($(this).attr('id-user')) : 0;
	let idCurentBlockMsg =  $('.id-to').attr('id-to') ? parseInt($('.id-to').attr('id-to')) : 0;
	if(idUser != idCurentBlockMsg) {
		$.ajax({
		    url: base_url + 'chat/load_broad_message',
		    type: 'POST',
		    data: {id: idUser},
		    beforeSend: function() {
		    	$('.loading-message').removeClass('d-none');
		    },
		    success: function (data) {
				//console.log(data);
				$('.header-body').html(data); 
				$('.loading-message').addClass('d-none');	 
		    }
		});
	}	
});

// add friend
$('.add-friend').click(function() {
	let idFriend = $(this).attr('id-friend') ? parseInt($(this).attr('id-friend')) : 0;
	if(idFriend > 0) {
		$.ajax({
		    url: base_url + 'chat/ajax_add_friend',
		    type: 'POST',
		    data: {id_friend: idFriend},
		    success: function (data) {
					console.log(data);
					let numberNoti = parseInt(data);
					let dataMsg = {
						type: 'add-friend',
						id_friend: idFriend,
						number: numberNoti
					};										
					if(numberNoti > 0) {
						console.log(numberNoti);	
						var ws = new WebSocket('ws://localhost:' + BROADCAST_PORT);
						ws.onopen = () => conn.send(JSON.stringify(dataMsg));
					}
					setTimeout(function(){		
						window.location = base_url + 'chat/add_friend';
					}, 300); 
		    }
		});
	}	
});

// acept friend
function isAcept(type, obj) {
	let idFriend = $(obj).attr('id-friend') ? parseInt($(obj).attr('id-friend')) : 0;
	if(idFriend > 0) {
		$.ajax({
		    url: base_url + 'chat/is_acept_friend',
		    type: 'POST',
		    data: {id_add_friend: idFriend, type: type},
		    success: function (data) {
					window.location = base_url + 'chat/acept_friend';
		    }
		});
	}	
}

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
		console.log(info);	
		idCrurent = parseInt(idCrurent);
		let idTo =  $('.id-to').attr('id-to') ? parseInt($('.id-to').attr('id-to')) : 0;
		if(info.type == 'add-friend') {
			if(info.id_friend == idCrurent) {
				$('.noti-add-friend').html(info.number);
			}
		}else if(info.type == 'send-mesage') {
			if(info.to_id == idCrurent || info.from_id == idCrurent) {			
				$.ajax({
						url: base_url + 'chat/create_mesage',
						type: 'POST',
						data: {id_curent: idCrurent, msg: info},
						success: function (result) {
						// send message for fromUser and toUser
						if(idTo == info.to_id || idTo == info.from_id) {
							$('.msg_card_body').append(result);
						}
							
							if(info.from_id == idCrurent) {
								$('.type_msg').val(' ');
						}
						// notificaion
						if(info.to_id == idCrurent) {
							if(idTo != info.from_id) {
									let url = 'chat/save_message_miss';
									let data = {user_id: info.to_id, friends_id: info.from_id};
									ajaxSaveMsgMiss(url, data);							
								}						
							}
						}
				});
			}
		}
	};
}catch (error) {
	console.log(error);
}

// ajax
function ajaxSaveMsgMiss(url, data) {
	let info = data;
	$.ajax({
		url: base_url + url,
		type: 'POST',
		data: data,
		typeData: 'JSON',
		success: function (result) {
			let obj = JSON.parse(result);
			if(obj.success == 1) {
				$('.notifi-' + info.friends_id).html(obj.countMsgMiss);
			}
		}
	});
}
// save mesage
function send_message(BROADCAST_URL, BROADCAST_PORT) {
	let msg = $('.type_msg').val();
	let idForm = $('body').attr('id') ?  parseInt($('body').attr('id')) : 0;
	let idTo = $('.id-to').attr('id-to') ? parseInt($('.id-to').attr('id-to')) : 0;
	// send image
	myDropzone.processQueue(); 
	var h =0;
	var strImage = '';
 	myDropzone.on('success', function(file, response) {	
 		h++;
 		if(h == 1) {
			strImage = 	response;	
 		}
	 });

	 // sau 0.3s thi save mesage
	setTimeout(function(){		
		let dataMsg = {
			type: 'send-mesage',
			msg: msg,
			from_id: idForm,
			to_id: idTo,
			list_image: strImage
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
	}, 300); 
	
 	// remove image
	setTimeout(function(){		
		myDropzone.removeAllFiles(true);
	}, 600); 
}

var previewTemplate = '<div class="image-area-box">' +
							'<i data-dz-size ></i>' +
							'<img data-dz-thumbnail src=""><i data-dz-remove class="fas fa-times"></i>'+
							'<i data-dz-errormessage></i>' +
						'</div>';

var myDropzone = new Dropzone(document.body, {
	url:  base_url + 'chat/uploads',
	datatype: 'JSON',
	autoProcessQueue: false,
	uploadMultiple: true,
	parallelUploads: 5,
	maxFiles: 3,
	maxFilesize: 1,
	acceptedFiles: '.png, .jpg, .txt, .pdf, .doc, .rar',
	//addRemoveLinks: true,
	thumbnailWidth: 80,
	thumbnailHeight: 80,
	parallelUploads: 20,
	previewTemplate: previewTemplate,
	//autoQueue: false,
	previewsContainer: "#previews",
	clickable: ".fileinput-button"
});

myDropzone.autoDiscover = false;


// $( document ).ready(function() {
//     //get list friend sau 3S
// 	setInterval(function(){
// 		let idCrurent = $('body').attr('id') ?  $('body').attr('id') : 0;
// 		if(parseInt(idCrurent) > 0) {
// 			$.ajax({
// 				url: base_url + 'chat/get_list_friend',
// 				type: 'POST',
// 				data: {user_id: idCrurent},
// 				success: function (data) {
// 					$('.list-friend').html(data);
// 				}
// 			});
// 		}
// 		console.log(1)
// 	}, 3000);
// });






