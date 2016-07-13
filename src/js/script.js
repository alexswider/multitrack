var userName = "me";

var users = [];

addEventListenersMain = function() {
    console.log("addEventListenersMain");
    $('form').submit(function() {
            console.log('chatsubmit');
            socket.emit('chat message', $('#m').val());
            $('#m').val('');
            return false;
        });

    $("#playBtn").click(function() {
        console.log("startClick");
        playSound("1");
        startTween();
        howMany();
        
    });
    $("#stopBtn").click(function() {
        console.log("startClick");
        changeTrack("2");
    });
    $("#amountBtn").click(function() {
        console.log("howManu");
       howMany();
    });
    $("#muteBtn").click(function() {
        console.log("toggleMute");
        muteToggle();
    });
    $("#connectBtn").click(function() {
        console.log("connecting to socket");
        initSocket();
        initAnim();
    });
}







