var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http)
var users = {};
var rooms = {};
var id_to_socket ={};

Array.prototype.diff = function (a) {
    return this.filter(function (i) {
        return a.indexOf(i) === -1;
    });
};

app.get('/', function(req, res){
	res.redirect('http://localhost/CHATv2/');
});

io.on('connection', function(socket){
	socket.on('join', function(user_id, name, room_id, room_list, img){
		if(room_list == -1){
			room_list = [];
		}
		users[socket.id] = {"name" : name, "room_id" : room_id, "room_list" : room_list,  "user_id" : user_id, "img" : img};
		id_to_socket[user_id.toString()] = socket.id;
		if(room_id > -1){
			socket.join(room_id);
		}

		for(i = 0; i < room_list.length; i++){
			var subscribe_room = 's_' + room_list[i];
			socket.join(subscribe_room);
			if(room_list[i] in rooms){
				rooms[room_list[i].toString()].push(user_id);
			}else{
				rooms[room_list[i].toString()] = new Array(user_id)
			}
			io.to(users[socket.id].room_list[i]).emit('update user', rooms[room_list[i]]);
		}
		console.log('log-in: ' + name);
		console.log('socket-id: ' + socket.id);
	});

	socket.on('update data', function(user_id, name, room_id, room_list, img){
		if(users[socket.id]){
			var past_room_id = users[socket.id]['room_id'];
			var new_room_id = room_id;
			if(room_list == -1){
				room_list = [];
			}

			if(past_room_id != new_room_id){
				if(new_room_id.toString() != "-1"){
					if(parseInt(past_room_id) > -1){
						socket.leave(past_room_id);
					}
					socket.join(new_room_id);
					socket.emit('update user', rooms[new_room_id.toString()]);
				}
				users[socket.id] = {"name" : name, "room_id" : room_id, "room_list" : room_list,  "user_id" : user_id, "img" : img};
			}
		}else{
			if(room_list == -1){
				room_list = [];
			}
			users[socket.id] = {"name" : name, "room_id" : room_id, "room_list" : room_list,  "user_id" : user_id, "img" : img};
			id_to_socket[user_id.toString()] = socket.id;
			if(room_id > -1){
				socket.join(room_id);
			}

			for(i = 0; i < room_list.length; i++){
				var subscribe_room = 's_' + room_list[i];
				socket.join(subscribe_room);
				if(room_list[i] in rooms){
					rooms[room_list[i].toString()].push(user_id);
				}else{
					rooms[room_list[i].toString()] = new Array(user_id)
				}
				io.to(users[socket.id].room_list[i]).emit('update user', rooms[room_list[i]]);
			}
			console.log('refresh log-in: ' + name);
			console.log('socket-id: ' + socket.id);
		}
	});

	socket.on('chat message', function(msg, tipe, time){
		if(users[socket.id]){
			var subscribe_room = 's_' + users[socket.id].room_id;
			io.to(users[socket.id].room_id).emit('chat message', users[socket.id].user_id, users[socket.id].name, msg, time, users[socket.id].img, tipe);
			io.to(subscribe_room).emit('new message notif', msg, time, users[socket.id].room_id, tipe);
		}
	});

	socket.on('add user', function(room, response, name, image){
		socket.broadcast.to(room.toString()).emit('add user', response);
		for(i = 0; i < response.length; i++){
			socket_id = id_to_socket[response[i]['id'].toString()];
			if(socket_id){
				io.sockets.connected[socket_id].emit('add chat', name, image, room);
			}
		}
	});

	socket.on('remove user', function(status){
		var room = users[socket.id].room_id;
		index = rooms[room.toString()].indexOf(users[socket.id].user_id);
		if(index > -1){
			rooms[room.toString()].splice(index, 1);
		}
		var subscribe_room = 's_' + room;
		socket.leave(subscribe_room);
		socket.leave(room.toString());
		socket.emit('removed', true);
		socket.broadcast.to(room.toString()).emit('remove user', users[socket.id].user_id, users[socket.id].name, users[socket.id].img);
	});

	socket.on('add chat', function(name, image, room, list){
		rooms[parseInt(room)] = new Array();
		for(i = 0; i < list.length; i++){
			socket_id = id_to_socket[list[i].toString()];
			if(socket_id){
				io.sockets.connected[socket_id].emit('add chat', name, image, room);
			}
		}
	});

	socket.on('join chat', function(room, user_id){
		var subscribe_room = 's_' + room;
		socket.join(subscribe_room);
		rooms[room.toString()].push(user_id);
		io.to(subscribe_room).emit('update user', rooms[room.toString()]);
	});

	socket.on("disconnect", function(){
		if(users[socket.id]){
			var room_list = users[socket.id]["room_list"];
			var index = 0;
			for(i = 0; i < room_list.length; i++){
				if(rooms[room_list[i].toString()]){
					index = rooms[room_list[i].toString()].indexOf(users[socket.id].user_id);
					if(index > -1){
						rooms[room_list[i].toString()].splice(index, 1);
						io.to(room_list[i].toString()).emit('user logout', users[socket.id].user_id, rooms[room_list[i].toString()]);
					}
				}
			};
			delete id_to_socket[users[socket.id].user_id];
		}
		delete users[socket.id];
		console.log('disconnect: ' + socket.id);
	});
});

http.listen(3000, function(){
	console.log('listening on *:3000');
});