function go_to(room){
	mod_server_url =  window.server_url + room + " #body_page  > *"

	$("#body_page").load(mod_server_url, function(response, status, xhr) {
		if ( status == "error" ) {
			$('.md_loading').modal('hide');
			$('.md_error').modal('show');
		}else{
			cc_cancel();
			au_cancel();
			$('#upload_file').val('');
			$('#form_file')[0].reset();
			$('#select_friend').empty();
			$('#select_friend').load(window.modal_1_url);
			if(parseInt(room) > -1){
				$('#au_select_friend').empty();
				$('#au_select_friend').load(window.modal_2_url);
			}
			update_page($('#sender').text(), $('#send_user').val(), $('#send_img').attr('value'), $('#send_room').val(), $('#send_all_room').val());
			check_size();
			attach_basic();
			scroll($('#unread').attr('value'), $('#list_chat').attr('value'));
			$('.md_loading').modal('hide');
		}
	});
}

function sf_cancel(){
	$('.md_sendfile').modal('hide');
	$('#upload_file').val('');
	$('#form_file')[0].reset();
}

function cc_cancel(){
	$('#cc_chat_name').val('');
	$('#cc_friend_list').val('');
	$("#cc_selection a").remove();
	$('#select_friend div').removeClass().addClass('item select_option');
	if(!$('#cc_warn_list').hasClass( "hiddened" )){
		$('#cc_warn_list').addClass('hiddened');
	}
	if(!$('#cc_warn_name').hasClass( "hiddened" )){
		$('#cc_warn_name').addClass('hiddened');
	}
}

function au_add(response, server_url){
	for(i = 0; i < response.length; i++){
		var id_removed = '#friend_' + response[i]['id'];
		var new_user = '<div class="item" id="user_' + response[i]['id'] +'"><div class="ui comments white"><div class="comment"><div class="content"><div class="ui grid"><div class="three wide column"><a class="avatar"><img src="' + server_url + response[i]['profile_pict'] + '"></a></div><div class="nine wide column"><a class="author">' + response[i]['nama'] + '</a><div class="text status" id="status_' + response[i]['id'] + '">Offline</div></div><div class="three wide column"><div class="led-box"><div class="led-red" id="ledlamp_' + response[i]['id'] + '"></div></div></div></div></div></div></div></div>';
		$('#list_user').append(new_user);
		$(id_removed).remove();
	}
}

function au_cancel(){
	$('#au_room').val('');
	$('#au_list').val('');
	$("#au_selection a").remove();
	$('#au_select_friend div').removeClass().addClass('item select_option');
	if(!$('#au_warn_user').hasClass( "hiddened" )){
		$('#au_warn_user').addClass('hiddened');
	}
}

function post_data(data, server_url){
	$.ajax({
		url: server_url,
		type: 'post',
		dataType : "json",
		data: data,
		error: function(response){
		}
	})
}

function logoutuser(logout_id, remaining_id){
	var temp_item = "#status_" + logout_id;
	$(temp_item).text("Offline");
	var temp_item = "#ledlamp_" + logout_id;
	$(temp_item).removeClass('led-blue');
	$(temp_item).addClass('led-red');

	for(index = 0; index < remaining_id.length; index++){
		var temp_item = "#user_" + remaining_id[index];
		$(temp_item).prependTo("#list_user");
	}
}


function updateuser(list_user){
	for (index = 0; index < list_user.length; index++) {
		var temp_item = "#user_" + list_user[index];
		$(temp_item).prependTo("#list_user");
		var temp_item = "#status_" + list_user[index];
		$(temp_item).text("Online");
		var temp_item = "#ledlamp_" + list_user[index];
		$(temp_item).removeClass('led-red');
		$(temp_item).addClass('led-blue');
	}
}

function newmessage(msg, time, room, room_id, basic_url, tipe){
	var temp_item = "#room_" + room_id;
	$(temp_item).prependTo("#irp");
	var temp_item = "#msg_new_" + room_id;
	if(parseInt(tipe) == 2){
		$(temp_item).text("[system] Image send by user");
	}else if(parseInt(tipe) == 3){
		$(temp_item).text("[system] File send by user");
	}else if(parseInt(tipe) == 4){
		$(temp_item).text("[system] Audio send by user");
	}else if(parseInt(tipe) == 5){
		$(temp_item).text("[system] Video send by user");
	}else{
		$(temp_item).text(msg);
	}

	var temp_item = "#msg_time_" + room_id;
	$(temp_item).text(time);
	if(parseInt(room_id) != parseInt(room)){
		var temp_item = "#notif_" + room_id;
		var unread = parseInt($(temp_item).text()) + 1;
		$(temp_item).text(unread);
		$(temp_item).removeClass('hiddened');

		var data = { 
			room: room_id, 
			unread : unread
		};
		post_data(data, basic_url);
	}
}

function receivemessage(sender_id, id, who, msg, time, img_url, tipe){
	var description;
	if(sender_id == id){
		$('.main_chat').append('<div class="two column row"><div class="four wide column"></div><div class="twelve wide column"><div class="ui right floated comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author c_author"></a><div class="metadata"></div><div class="text msg_data mod_send"></div></div></div></div></div></div>');
	}else{
		$('.main_chat').append('<div class="two column row"><div class="twelve wide column"><div class="ui comments"> <div class="comment"><a class="avatar c_avatar"></a><div class="content com_con"><a class="author c_author"></a><div class="metadata"></div><div class="text msg_data mod_receive"></div></div></div></div></div></div>');
	}
	var img = $('<img>', {"src": img_url});
	$('.c_avatar').last().append(img);
	$('.c_author').last().text(who);
	var date = $('<div>', {"class": "date"}).text(time);
	$('.metadata').last().append(date);
	if(parseInt(tipe) == 2){
		description = $('<img>').attr("src", msg).addClass('msg_image');
	}else if(parseInt(tipe) == 3){
		index_start = msg.lastIndexOf("/") + 1;
		index_end = msg.length;
		description = '<p>' + msg.slice(index_start, index_end)  + ' :</p><a href="' + msg +'" download><div class="ui center aligned segment"><i class="download icon" style="font-size: 6em !important;"></i></div></a>';
	}else if(parseInt(tipe) == 4){
		index_start = msg.lastIndexOf("/") + 1;
		index_end = msg.length;
		description = '<p>' + msg.slice(index_start, index_end)  + ' :</p><audio controls class="msg_audio"><source src="' + msg +'" type="audio/mpeg"></audio>';
	}else if(parseInt(tipe) == 5){
		description = '<video controls class="msg_video"><source src="'+ msg +'" type="video/mp4"></video>';
	}else{
		description = $('<p>').text(msg);
	}
	$('.msg_data').last().append(description);
}

function scrolltobottom(){
	var distance = $('.main')[0].scrollHeight;
	$('.main').animate({scrollTop: distance}, 'slow');
}

function attach_basic(){
	$('#sd_chatlist')
	.sidebar({
		context: $('.bottom.segment')
	}).sidebar('attach events', '#sd_clbutton');

	$('#sd_groupuser')
	.sidebar({
		context: $('.bottom.segment')
	}).sidebar('attach events', '#sd_gubutton');

	if($('#send_room').val() > -1){
		$('.md_adduser').modal('attach events', '#au_button', 'show');
		$('.md_leavegroup').modal('attach events', '#lg_button', 'show');
	}

	$('.dropdown').dropdown({});
}

function scroll(unread, count_chat){
	if(unread && unread > -1){
		if(unread > 0 && count_chat > 1){
			var child = $('#chat_' + (count_chat - unread));
			var p_id = "#" + $(".main_chat:first-child").attr("id");
			var parent = $(p_id);
			var distance =  child.offset().top - parent.offset().top;
			$('.main').animate({scrollTop: distance}, 'slow');
		}else{
			scrolltobottom();
		}
	}
};

$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("active");
});

function check_size(){
	var is_iPad = navigator.userAgent.match(/iPad/i) != null;
	if (window.matchMedia('(min-width: 1024px)').matches && !is_iPad) {
		$('.big_bold').css('font-size','2vw !important;');
		$('#item_container').prependTo('#bg_chatlist');
		$('#user_container').prependTo('#bg_groupuser');
		$('#bg_chatlist').addClass('visible');
		$('#bg_groupuser').addClass('visible');
		$('#bg_topmenu').removeClass('hiddened');
		$('#sm_topmenu').addClass('hiddened');
		$('#main_body').css('width','calc(100vw - 350px)');
		if($(window).width() > 1250){
			$('#main_container').css('width','calc(80vw - 350px)');
			$('#bg_groupuser').css('width','20vw');
		}else{
			$('#main_container').css('width','calc(100vw - 601px)');
			$('#bg_groupuser').css('width','251px');
		}
		$('.main').css('height','84vh');
		$('.chat_message').css('height', '5vh');
		$('#bt_sndmsg').css('width', '5vh');
		$('#bt_sndmsg').css('height', '5vh');
		$('#footer').css('width', 'calc(100% - 2em)');
		$('#footer').css('height', '8vh');
		$('#msg_area').removeClass('fourteen wide column');
		$('#msg_area').addClass('fifteen wide column');
		$('#btn_send').removeClass('two wide column');
		$('#btn_send').addClass('one wide column');
	} else if(window.matchMedia('(min-width: 768px)').matches) {
		var temp = 'calc(' + window.innerHeight + 'px - 100px)';
		$('.big_bold').css('font-size','5vw !important;');
		$('#item_container').prependTo('#sd_chatlist');
		$('#user_container').prependTo('#bg_groupuser');
		$('#sd_gubutton').addClass('hiddened');
		$('#bg_chatlist').removeClass('visible');
		$('#bg_groupuser').addClass('visible');
		$('#sm_topmenu').removeClass('hiddened');
		$('#bg_topmenu').addClass('hiddened');
		$('#main_body').css('width','100vw');
		if($(window).width() > 833){
			$('#main_container').css('width','70vw');
			$('#bg_groupuser').css('width','30vw');
		}else{
			$('#main_container').css('width','calc(100vw - 251px)');
			$('#bg_groupuser').css('width','251px');
		}
		$('.main').css('height', temp);
		$('.chat_message').css('height', '35px');
		$('#bt_sndmsg').css('width', '35px');
		$('#bt_sndmsg').css('height', '35px');
		$('#footer').css('width', '100%');
		$('#footer').css('height', '55px');
		$('#msg_area').removeClass('fifteen wide column');
		$('#msg_area').addClass('fourteen wide column');
		$('#btn_send').removeClass('one wide column');
		$('#btn_send').addClass('two wide column');
	}else{
		var temp = 'calc(' + window.innerHeight + 'px - 90px)';
		$('.big_bold').css('font-size','5vw !important;');
		$('#item_container').prependTo('#sd_chatlist');
		$('#user_container').prependTo('#sd_groupuser');
		$('#sd_gubutton').removeClass('hiddened');
		$('#bg_chatlist').removeClass('visible');
		$('#bg_groupuser').removeClass('visible');
		$('#sm_topmenu').removeClass('hiddened');
		$('#bg_topmenu').addClass('hiddened');
		$('#main_body').css('width','100vw');
		$('#main_container').css('width','100vw');
		$('.main').css('height',temp);
		$('.chat_message').css('height', '35px');
		$('#bt_sndmsg').css('width', '35px');
		$('#bt_sndmsg').css('height', '35px');
		$('#footer').css('width', '100%');
		$('#footer').css('height', '45px');
		$('#msg_area').removeClass('fifteen wide column');
		$('#msg_area').addClass('fourteen wide column');
		$('#btn_send').removeClass('one wide column');
		$('#btn_send').addClass('two wide column');
	}
}

$(window).on('load', check_size);

$(window).on('resize',check_size);

function init(){
	$(document).on("click", ".msg_image", function(){
		var source = $(this).attr('src');
		$('#image_modal').attr('src', source);
		$('#md_imagemodal').modal('show');
	});

	$(document).on("keyup", "#search_room", function(){
		var input = $('#search_room').val();
		filter = input.toUpperCase();
		$('.change_room').each(function() {
			var child_div = $(this).find('.header');
			var div_text = child_div.text();
			if(div_text.toUpperCase().indexOf(filter) > -1){
				$(this).css('display', '');
			}else{
				$(this).css('display', 'none');
			}
		});
	});

	$(document).on("click",".bt_sendfile", function(){
		$('.md_sendfile').modal('show');
	});

	$(document).on("click","#sf_cancel", function(){
		sf_cancel();
	});

	$(document).on("click","#sf_send", function(){
		$('.md_sendfile').modal('hide');
		$('.md_loading').modal('setting', 'closable', false).modal('show');

		var fileSelect = document.getElementById('upload_file');
		var files = fileSelect.files;
		var formData = new FormData();
		var file = files[0];            
		formData.append('file', file, file.name);
		$.ajax({
			url: window.uploadfile_url, 
			dataType: 'JSON', 
			cache: false,
			contentType: false,
			processData: false,
			data: formData,
			type: 'POST',
			success: function(data){
				if(data){
					$('#upload_file').val('');
					$('#form_file')[0].reset();
					socket.emit('chat message', data.url, data.tipe, data.time);
					$('.md_loading').modal('hide');
				}else{
					$('.md_loading').modal('hide');
					$('.md_errorfile').modal('show');
				}
			},
			error: function(data){
				$('.md_loading').modal('hide');
				$('.md_error').modal('show');
			}
		});
	});

	$(document).on("click","#nc_button", function(){
		$('#md_createchat').modal('show');
	});

	$(document).on("click",".change_room", function(){
		var button_id = $(this).attr('id');
		button_id = button_id.split('_')[1];
		$('.md_loading').modal('setting', 'closable', false).modal('show');
		go_to(button_id);
	});

	$(document).on("click","#ok_createchat", function(){
		if($('#cc_chat_name').val() && $('#cc_friend_list').val()) {
			$('#md_createchat').modal('hide');
			$('.md_loading').modal('setting', 'closable', false).modal('show');

			$.ajax({
				url: window.createchat_url,
				type: 'post',
				dataType : "json",
				data: { 
					group_name: $('#cc_chat_name').val(),
					user_id: $('#send_user').val(),
					friend_list : $('#cc_friend_list').val(),
				},

				success: function(response){
					cc_cancel();
					window.socket.emit('add chat', response.name, response.image, response.room, response.list);
					window.socket.emit('join chat', response.room, $('#send_user').val());
					go_to(response.room);
				},
				error: function(){
					$('.md_loading').modal('hide');
					$('.md_error').modal('show');
				}
			});
		}else{
			if(!$('#cc_chat_name').val()){
				$('#cc_warn_name').removeClass('hiddened');
			}else if(!$('#cc_warn_name').hasClass('hiddened')){
				$('#cc_warn_name').addClass('hiddened');
			}

			if(!$('#cc_friend_list').val()){
				$('#cc_warn_list').removeClass('hiddened');
			}else if(!$('#cc_warn_list').hasClass('hiddened')){
				$('#cc_warn_list').addClass('hiddened');
			}
		}
	});

	$(document).on("click","#cancel_createchat", function(){ 
		$('#md_createchat').modal('hide');
		cc_cancel();
	});

	$(document).on("click","#au_cancel", function(){
		$('.md_adduser').modal('hide');
		au_cancel();
	});

	$(document).on("click","#lc_ok", function(){
		$('.md_leavegroup').modal('hide');
		$('.md_loading').modal('show');

		$.ajax({
			url: window.leavechat_url,
			type: 'post',
			dataType : "json",
			data: { 
				room: $('#send_room').val(), 
				user_id: $('#send_user').val()
			},

			success: function(data){
				window.socket.emit('remove user', true);
			},

			error: function(error){
				$('.md_loading').modal('hide');
				$('.md_error').modal('show');
			}
		});
	});

	$(document).on("click","#au_add", function(){
		if($('#au_list').val()) {
			$('.md_adduser').modal('hide');
			$('.md_loading').modal('setting', 'closable', false).modal('show');
			$.ajax({
				url: window.adduser_url,
				type: 'post',
				dataType : "json",
				data: { 
					room: $('#send_room').val(),
					user_list: $('#au_list').val(),
				},
				success: function(response){
					au_cancel();
					window.socket.emit('add user', $('#send_room').val(), response, $('#grouproom_name').attr('value'), $('#grouproom_image').attr('value'));
					au_add(response, window.imagebase_url);
					$('.md_loading').modal('hide');
				},
				error: function(response){
					$('.md_loading').modal('hide');
					$('.md_error').modal('show');
				}
			});
		}else{
			if(!$('#au_list').val()){
				$('#au_warn_user').removeClass('hiddened');
			}else if(!$('#au_warn_user').hasClass( "hiddened" )){
				$('#au_warn_user').addClass('hiddened');
			}
		}
	});

	$(document).on("submit",".formsend", function(e){
		e.preventDefault();
		e.returnValue = false;
		if( $('#send_room').val() > -1){
			var msg_val =  $('.chat_message').val();
			var data = { 
				tipe : 1,
				msg : msg_val
			};

			$.ajax({
				url: window.sendmsg_url,
				type: 'post',
				dataType : "json",
				data: data,
				success: function(time){
					window.socket.emit('chat message', msg_val, 1, time);
				}
			});
		}   
		$('.chat_message').val('');
	});
};

