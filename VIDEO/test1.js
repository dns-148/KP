//deklarasi awal
var express = require("express");
var app = express();
var server_http = require("http").Server(app);
var io = require("socket.io")(server_http);
var users = {} ;

app.use(express.static(__dirname + "/public"));

server_http.listen(3003, function(){
	console.log('connected on port 3003');

});

app.get('/', function(req,res){
	res.redirect('index.html');

}); 

io.sockets.on('connection',function(socket){

	//ini nanti fungsi stream
	socket.on('stream', function(data,image){
		
		if (data in users){
			console.log(data);
			console.log('masuk stream');
			users[data].emit('stream', image);
			console.log('masuk stream 2');
		}
		
	});

	// Fungsi User Baru
	socket.on('new user', function(data, callback){
		console.log(socket.id);
		if(data in users){
			callback(false);
			
		}
		else{
			callback(true);
			socket.nickname = data;
			users[socket.nickname] = socket;
			updateNicknames();
		}
	});

	//Fungsi Update
	function updateNicknames(){
		io.sockets.emit('usernames', Object.keys(users)); 
	}

	//Fungsi Disconnect
	socket.on('disconnect', function(data){
		if(!socket.nickname) return;
		delete users[socket.nickname];
		updateNicknames();
	});

});