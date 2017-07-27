function au_cancel(){
	$('.md_adduser').modal('hide');
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

function newmessage(msg, time, room, room_id, basic_url, user_id){
	var temp_item = "#room_" + room_id;
	$(temp_item).prependTo("#irp");
	var temp_item = "#msg_new_" + room_id;
	$(temp_item).text(msg);
	var temp_item = "#msg_time_" + room_id;
	$(temp_item).text(time);
	if(room_id != room){
		var temp_item = "#notif_" + room_id;
		var unread = parseInt($(temp_item).text()) + 1;
		$(temp_item).text(unread);
		$(temp_item).removeClass('hidden');

		var data = { 
			room: room_id, 
			user_id: user_id,
			unread : unread
		};
		post_data(data, basic_url);
	}
}

function receivemessage(sender_id, id, who, msg, time, img_url){
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
	var description = $('<p>').text(msg);
	$('.msg_data').last().append(description);
}

function scrolltobottom(){
	var distance = $('.main')[0].scrollHeight;
	$('.main').animate({scrollTop: distance}, 'slow');
}

function scroll(unread, count_chat){
	if(unread > -1){
		if(unread > 0 && count_chat > 1){
			var child = $('#chat_' + (count_chat - unread));
			var parent = $('#chat_1');
			var distance =  child.offset().top-parent.offset().top;
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
		$('#bg_chatlist').addClass('visible');
		$('#bg_groupuser').addClass('visible');
		if($(window).width() > 1250){
			$('#main_body').css('width','calc(80vw - 350px)');
			$('#bg_groupuser').css('width','20vw');
		}else{
			$('#main_body').css('width','calc(100vw - 601px)');
			$('#bg_groupuser').css('width','251px');
		}
		$('#footer').css('width', 'calc(100% - 2em)');
		$('#msg_area').removeClass('fourteen wide column');
		$('#msg_area').addClass('fifteen wide column');
		$('#btn_send').removeClass('two wide column');
		$('#btn_send').addClass('one wide column');
	} else if(window.matchMedia('(min-width: 768px)').matches) {
		$('#bg_chatlist').removeClass('visible');
		$('#bg_groupuser').addClass('visible');
		if($(window).width() > 833){
			$('#bg_groupuser').css('width','30vw');
			$('#main_body').css('width','70vw');
		}else{
			$('#main_body').css('width','calc(100vw - 251px)');
			$('#bg_groupuser').css('width','251px');
		}
		$('#footer').css('width', '100%');
		$('#msg_area').removeClass('fifteen wide column');
		$('#msg_area').addClass('fourteen wide column');
		$('#btn_send').removeClass('one wide column');
		$('#btn_send').addClass('two wide column');
	}else{
		$('#bg_chatlist').removeClass('visible');
		$('#bg_groupuser').removeClass('visible');
		$('#main_body').css('width','100vw');
		$('#footer').css('width', '100%');
		$('#msg_area').removeClass('fifteen wide column');
		$('#msg_area').addClass('fourteen wide column');
		$('#btn_send').removeClass('one wide column');
		$('#btn_send').addClass('two wide column');
	}
}

$(window).on('load', check_size);

$(window).on('resize',check_size);

