var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
//var __dirname = "./dist";

app.get('/', function(req, res){
  res.sendFile(__dirname + '/dist/index.html');
});
app.use('/swf', express.static('swf'));
app.use('/css', express.static('css'));
app.use('/sounds', express.static('sounds'));

io.on('connection', function(socket){
  socket.on('chat message', function(msg){
    console.log('message: ' + msg);
    io.emit('chat message', msg);
  });
});

http.listen(3000, function(){
  console.log('listening on *:3000');
});
