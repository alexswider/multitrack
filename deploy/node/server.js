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
	    socket.room = room_number;
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






/*
var server = require('http').Server();
var io = require('socket.io')(server);
io.on('connection', function(socket){
  socket.on('event', function(data){
  	console.log("event");

  });
  socket.on('disconnect', function(){
  	console.log("disconnect");

  });
});
server.listen(3010);
*/

/*
var PORT = 3000;
var app = require('express')(),
    server = require('http').createServer(app),
    io = require('socket.io').listen(server);

server.listen(PORT);

app.get('/room/*', function (req, res){
    res.sendfile(__dirname + '/room.html');
});

io.sockets.on('connection', function(socket){

	socket.on('user_join', function(username, room_number){
	    socket.username = username;
	    socket.room = room_number;
	    socket.join(room_number);
	});

	socket.on('send_message', function(message){
	    socket.broadcast.to(socket.room).emit('update_chat', socket.username, message);
	});

	socket.on('disconnect', function(){
	    socket.leave(socket.room);
	});


});

*/

/*

// Gets the 123 out of /room/123
var room = window.location.pathname.substring(6);
var socket = io.connect("http://mydomain.com:3000/room.html");

    socket.on("connect", function(){
        socket.emit('user_join', "Bob", room);
    });

    socket.on("update_chat", function(username, message){
        addChatMessage(username, message);
        messages.push({username : username, message : message});
    });

 */