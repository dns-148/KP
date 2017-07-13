var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http)
var users = {};
var names = {};

app.get('/', function(req, res){
  res.redirect('http://localhost/CHATv2/');
});

io.on('connection', function(socket){
  socket.on('join', function(username, name){
      users[socket.id] = username;
      names[users[socket.id]] = name;
  });

  socket.on('chat message', function(msg){
    console.log('message: ' + msg);
    io.emit('chat message', users[socket.id], names[users[socket.id]], msg);
  });
  
  socket.on("disconnect", function(){
    delete users[socket.id];
  });
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});