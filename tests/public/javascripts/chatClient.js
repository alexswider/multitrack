//Socket.io
var socket = io.connect();
socket.on('connect', function() {
	console.log('connected');
});
socket.on('nbUsers', function(msg) {
	$("#nbUsers").html(msg.nb);
});
socket.on('message', function(data) {
	addMessage(data['message'], data['pseudo'], new Date().toISOString(), false);
	console.log(data);
});