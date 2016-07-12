var userName = "me";

var users = [];

addEventListenersMain = function() {
    console.log("addEventListenersMain");
    

    $("#playBtn").click(function() {
        console.log("startClick");
        playSound("1");

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
}


