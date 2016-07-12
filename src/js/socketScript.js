    var socket = io();

    function initSocket(){

        $('form').submit(function() {
            console.log('chatsubmit');
            socket.emit('chat message', $('#m').val());
            $('#m').val('');
            return false;
        });
        socket.on('chat message', function(msg) {
            $('#messages').append($('<li>').text(msg));
        });
        socket.on("connect", function() {
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


}


function howMany(){
    socket.emit("/howMany?");
}


sendBrowserClosedMessageToServer = function(){
    io.emit('disconnect');
}
