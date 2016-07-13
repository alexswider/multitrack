var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http, {'pingInterval': 3000, 'pingTimeout': 1000});
//var __dirname = "./dist";
var  env = "src";

app.get('/', function(req, res){
  res.sendFile(__dirname +"/src/index.html");
 //res.sendFile(__dirname +"/src/sample.html");
});
app.use('/swf', express.static('swf'));
app.use('/css', express.static(env+'/css'));
app.use('/img', express.static(env+'/img'));
app.use('/sounds', express.static(env+'/sounds'));
app.use('/soundjs', express.static(env+'/soundjs'));
app.use('/js', express.static(env+'/js'));
app.use('/libs', express.static(env+'/libs'));

io.on('connection', function(socket){
  
  socket.on('chat message', function(msg){
    console.log('message: ' + msg);
    io.emit('chat message', msg);
  });

  socket.on('/howMany?', function(){
    io.emit("users_amount",io.engine.clientsCount);
  });

  io.emit('chat message', "person added || total: "+io.engine.clientsCount);
  io.emit("users_amount",io.engine.clientsCount);
  console.log("users: "+io.engine.clientsCount);

  socket.on('disconnect', function () {
        console.log('DISCONNECT!!! ');
        io.emit("users_amount",io.engine.clientsCount);   
    });

});

http.listen(3000, function(){
  console.log('listening on *:3000');
});
