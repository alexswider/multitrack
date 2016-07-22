    var socket;

function initSocket(){
        socket = io();
        
        socket.on('chat message', function(msg) {
            $('#messages').append($('<li>').text(msg));
        });
        socket.on("connect", function() {
            $("#playBtn").css("display","block");
             $("#muteBtn").css("display","block");
            socket.emit('user_join', "--");
            console.log("connected");
        });


        socket.on("user_join", function() {
            console.log("userJoined:");
            // document.getElementById("flashcontent").UserJoined();
        });

        socket.on("users_amount",function(msg){
            console.log("users_amount:"+msg);
            changeTrack(msg);
        });

        showChatRoom();
}


function howMany(){
    socket.emit("/howMany?");
}


sendBrowserClosedMessageToServer = function(){
    io.emit('disconnect');
}


showChatRoom = function(){
    console.log("showchatroom");
    $("#right").css("display","block");
}

