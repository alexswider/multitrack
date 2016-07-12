var display;
var instance;
var currentID = "";
var volume;
var mute = false;
var position = 0;


function initSound() {
     if (!createjs.Sound.initializeDefaultPlugins()) {
        return; }

    var audioPath = "sounds/";
    var sounds = [
        { id: "1", src: "1.mp3" },
        { id: "2", src: "2.mp3" },
        { id: "3", src: "3.mp3" },
        { id: "4", src: "4.mp3" },
        { id: "thunder", src: "Thunder1.mp3" }

    ];

   console.log("loading audio");
    createjs.Sound.alternateExtensions = ["mp3"];
    var loadProxy = createjs.proxy(this.handleLoad, this);
    createjs.Sound.addEventListener("fileload", loadProxy);
    createjs.Sound.registerSounds(sounds, audioPath);
}

function handleLoad(event) {
    console.log("sound:soundfiles loaded:"+event.src);
    
}

function playSound(id){
    instance = createjs.Sound.play(id);
    console.log("Playing " + id);
    currentID = id;
}

function changeTrack(_id){
    console.log(instance);
    if(!instance)return;
    position = instance.getPosition();
    createjs.Sound.stop();
    instance = createjs.Sound.play(_id);
    instance.position = position;
}

function pauseToggle(){
    instance.paused ? instance.paused = false : instance.paused = true;
}

function muteToggle(){
 if(mute == false){
    volume = instance.volume;
    instance.volume = 0;
    mute = true;
     $("#muteBtn").text("unmute");
 }else{
    instance.volume = volume;
    mute = false;
    $("#muteBtn").text("mute");
 }
   
}

function checkTimeOnCurrentTrack(){
    console.log("position: "+instance.getPosition());
}