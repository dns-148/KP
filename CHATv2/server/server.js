var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http)
var users = {};
var rooms = {};
var id_to_socket ={};

app.get('/', function(req, res){
	res.redirect('http://localhost/CHATv2/');
});

io.on('connection', function(socket){
	socket.on('join', function(user_id, name, room_id, room_list, img){
		users[socket.id] = {"name" : name, "room_id" : room_id, "room_list" : room_list,  "user_id" : user_id, "img" : img};
		id_to_socket[user_id.toString()] = socket.id;
		if(room_id > -1){
			socket.join(room_id);
		}

		for(i = 0; i < room_list.length; i++){
			var subscribe_room = 's_' + room_list[i];
			socket.join(subscribe_room);
			if(room_list[i] in rooms){
				rooms[room_list[i]].push(user_id);
			}else{
				rooms[room_list[i]] = new Array(user_id)
			}
			io.to(users[socket.id].room_list[i]).emit('update user', rooms[room_list[i]]);
		}
	});

	socket.on('chat message', function(msg, time){
		var subscribe_room = 's_' + users[socket.id].room_id;
		io.to(users[socket.id].room_id).emit('chat message', users[socket.id].user_id, users[socket.id].name, msg, time, users[socket.id].img);
		io.to(subscribe_room).emit('new message notif', msg, time, users[socket.id].room_id);
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

	socket.on('remove user', function(room, id, nama, image){
		socket.emit('removed', true);
		socket.broadcast.to(room.toString()).emit('remove user', id, nama, image);
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
				index = rooms[room_list[i]].indexOf(users[socket.id].user_id);
				if(index > -1){
					rooms[room_list[i]].splice(index, 1);
					io.to(users[socket.id].room_list[i]).emit('user logout', users[socket.id].user_id, rooms[room_list[i]]);
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