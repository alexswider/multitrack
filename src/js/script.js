    var socket = io();
    $('form').submit(function() {
        socket.emit('chat message', $('#m').val());
        $('#m').val('');
        return false;
    });
    socket.on('chat message', function(msg) {
        $('#messages').append($('<li>').text(msg));
    });
    socket.on("connect", function(){
        socket.emit('user_join', "Bob");
        console.log("connected");
    });


    socket.on("user_join", function(){
        console.log("userJoined:");
        document.getElementById("flashcontent").UserJoined();
    });

