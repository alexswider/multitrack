var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
	res.sendfile('index.html');
});

http.listen(3010, function(){
	console.log('listening on *:3010');
});

io.on('connection', function(socket){
  	console.log('a user connected ->');

  	socket.on('user_join', function(username, room_number){
	    socket.username = username;
	    socket.room = 666 ;//room_number;
	    socket.join(room_number);
	    socket.broadcast.to(room_number).emit("update_chat", username, "user join the room ");
	    socket.broadcast.to(room_number).emit("user_join", username);
	    console.log("user: "+socket.username+" joined | room: "+socket.room+"");
	});
	
	socket.on('send_message', function(message){
	    socket.broadcast.to(socket.room).emit('update_chat', socket.username, message);
	    console.log("room:"+socket.room+" | user:"+ socket.username+" | message send:"+message);
	});


	socket.on('disconnect', function(){
	    console.log("disconnect");
	    socket.leave(socket.room);
	});
});



