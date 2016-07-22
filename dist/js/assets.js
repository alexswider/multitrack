var canvas,stage,manifest,loader,progressText;
 
function setupManifest() {
    manifest = [{
        src:  "img/Wave_1_Voices.png",
        id: "wave1"
    }, {
        src: "img/Wave_2_Bassline.png",
        id: "wave2"
    }, {
        src:  "img/Wave_3_Drums.png",
        id: "wave3"
    }, {
        src:  "img/Wave_4_SteelDrums.png",
        id: "wave4"
    }, {
        src:  "sounds/1.mp3",
        id: "sound1"
    }, {
        src:  "sounds/2.mp3",
        id: "sound2"
    }, {
        src:  "sounds/3.mp3",
        id: "sound3"
    }, {
        src:  "sounds/4.mp3",
        id: "sound4"
    }
 
    ];
    // for(var i=1;i<=13;i++)
    //     manifest.push({src:"c"+i+".png"})
}
 
function startloader() {
    loader = new createjs.LoadQueue(true);
    loader.installPlugin(createjs.Sound);          
    loader.on("fileload", handleFileLoad);
    loader.on("progress", handleFileProgress);
    loader.on("complete", loadComplete);
    loader.on("error", loadError);
    loader.loadManifest(manifest);
 
}
 
function handleFileLoad(event) {
    console.log("A file has loaded of type: " + event.item.type);
    if(event.item.id == "logo"){
        console.log("Logo is loaded");
        //create bitmap here
    }
}
 
 
function loadError(evt) {
    console.log("Error!",evt.text);
}
 
 
function handleFileProgress(event) {
    progressText.text = (loader.progress*100|0) + " % Loaded";
    stage.update();
}
 
function loadComplete(event) {
    console.log("Finished Loading Assets");
    $("#connectBtn").css("display","block");

     //initSocket();
     initSound();
     addEventListenersMain();
}

//from index.html
function loadAssets(){
    canvas  = document.getElementById("canvas1");
    stage = new createjs.Stage(canvas);
    progressText = new createjs.Text("", "20px Arial", "#000000");
    progressText.x = 300 - progressText.getMeasuredWidth() / 2;
    progressText.y = 20;
    stage.addChild(progressText);
    


    setupManifest();
    startloader();   
}