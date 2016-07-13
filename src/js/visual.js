var w,h;

var track1,track2,track3,track4;


initAnim = function(){
    w = stage.canvas.width;
    h = stage.canvas.height;

    var track1IMG = loader.getResult("wave1");
    track1 = new createjs.Shape();
    track1.graphics.beginBitmapFill(track1IMG).drawRect(0,0,w+track1IMG.width,track1IMG.height);
    track1.tileW = track1IMG.width;
    track1.y =0;
    track1.x = w/2;


    var track2IMG = loader.getResult("wave2");
    track2 = new createjs.Bitmap(track2IMG);
    track2.y = 200;
    track2.x = w/2;

    var track3IMG = loader.getResult("wave3");
    track3 = new createjs.Bitmap(track3IMG);
    track3.y = 400;
    track3.x = w/2;


    var track4IMG = loader.getResult("wave4");
    track4 = new createjs.Bitmap(track4IMG);
    track4.y = 600;
    track4.x = w/2;

    
    console.log(w,h);



    stage.addChild(track1);
    stage.addChild(track2);
    stage.addChild(track3);
    stage.addChild(track4);


    changeTracks(1);
    //var shape = new createjs.Shape();
    //shape.graphics.beginFill('red').drawRect(220, 220, 320, 320);
   // stage.addChild(shape);

    createjs.Ticker.addEventListener("tick", stage);
}

function tick(event) {
    // this set makes it so the stage only re-renders when an event handler indicates a change has happened.
  //  if (update) {
        //update = false; // only update once
        stage.update(event);
       var ball = tween._target;
  //  }
}

startTween = function(){
    var tween = createjs.Tween.get(track1, {loop: false})
            .to({x: -track1.tileW}, 172000);
    var tween2 = createjs.Tween.get(track2, {loop: false})
            .to({x: -track1.tileW}, 172000);
    var tween3 = createjs.Tween.get(track3, {loop: false})
            .to({x: -track1.tileW}, 172000);
    var tween4= createjs.Tween.get(track4, {loop: false})
            .to({x: -track1.tileW}, 172000);
}



changeTracks = function(val){
    switch (val){
        case 1:
            track1.alpha  =1;
            track2.alpha  =.2;
            track3.alpha  =.2;
            track4.alpha  =.2;
        break;

        case 2:
            track1.alpha  =1;
            track2.alpha  =1;
            track3.alpha  =.2;
            track4.alpha  =.2;
        break;

        case 3:
            track1.alpha  =1;
            track2.alpha  =1;
            track3.alpha  =1;
            track4.alpha  =.2;
        break;

        case 4:
            track1.alpha  =1;
            track2.alpha  =1;
            track3.alpha  =1;
            track4.alpha  =1;
        break;

    }
    
}