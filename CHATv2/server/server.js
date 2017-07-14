var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http)
var users = {};
var rooms = {};

app.get('/', function(req, res){
  res.redirect('http://192.168.0.110/CHATv2/');
});

io.on('connection', function(socket){
  socket.on('join', function(username, name, room_id){
      users[socket.id] = {"name" : name, "room_id" : room_id, "username" : username};
      socket.join(room_id);
  });

  socket.on('chat message', function(msg, time){
    console.log('message: ' + msg);
    console.log('room: ' + users[socket.id].room_id);
    io.to(users[socket.id].room_id).emit('chat message', users[socket.id].username, users[socket.id].name, msg, time);
  });
  
  socket.on("disconnect", function(){
    delete users[socket.id];
  });
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});