
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MULTI TRACK</title>

<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="js/util.js"></script>

<script src="node/node_modules/socket.io-client/socket.io.js"></script>
<!--
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/swfforcesize.js"></script>
-->
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/favicon.ico"/>



</head><body>
<!--
<div id="facebook">
  <a href="#" id="fb" onclick="auth_click()">Request this textbook</a></p>
</div>
-->
<object id="flashcontent" name="flashcontent" flashvars="roomID=<?php echo $_GET['id'];?>"
  type="application/x-shockwave-flash" data="swf/main.swf?<?php echo rand(); ?>" width="100%" height="90%">
    <param name="movie" value="swf/main.swf"/>
    <param name="quality" value="high"/>
    <param name='flashvars' value='roomID=<?php echo $_GET['id'];?>'/>
    <param name="allowscriptaccess" value="always"/>
    <a href="http://www.adobe.com/go/getflash">
        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
    </a>
  </object>
<div class="console">Console


</div>
<input id="scriptBox" class="consoleInput" name="say" type="text" value="" onkeypress="return runScript(event)"/>

<div id="fb-root"></div>
<script>
  //swfobject.registerObject("flashcontent", "11", "expressInstall.swf");
  var socket = io();
  // Gets the 123 out of /room/123
  var room = 12;//<?php echo $_GET['id'];?>;
  console.log("room from path:"+room);
  var socket = io.connect("localhost:3010");

    socket.on("connect", function(){
        //socket.emit('user_join', "Bob", room);
        console.log("connected");
    });

    socket.on("user_join", function(username){
        console.log("userJoined:"+_user+" | "+_room);
        document.getElementById("flashcontent").UserJoined();
    });


    socket.on("update_chat", function(username, message){
        console.log("update_chat:"+username+" | "+message);
        addChatMessage(username, message);
        //messages.push({username : username, message : message});
        //addChatMessage(username,message);
    });

  function runScript(e) {
    if (e.keyCode == 13) {
        var tb = document.getElementById("scriptBox");
        send(tb.value,room);
        //tb.html("");
        return false;
    }
  }



  function join_room(_user,_room){
    socket.emit('user_join', _user, _room);
    window.history.pushState('object or string', 'Title', 'index.php?id='+_room);
    console.log("updateURL");
  };

  function send(_val,_room){
    socket.emit('chat_message', _val,_room);
    console.log('message send:'+_val+" | room:"+_room);
    room = _room;
  };

  function addChatMessage(username,message){
    $("div.console").append("<p>"+username+":"+message+"</p>");
  };


  // window.fbAsyncInit = function() {
  //   FB.init({
  //     appId      : '526582300794681', // App ID
  //     channelUrl : '//prototypes.mingcompany.com/multitrack/channel.php', // Channel File
  //     status     : true, // check login status
  //     cookie     : true, // enable cookies to allow the server to access the session
  //     xfbml      : true  // parse XFBML


  //   });
  //   console.log("fbInit")
  //   // Additional initialization code here
  // };

  // // Load the SDK Asynchronously
  // (function(d){
  //    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
  //    if (d.getElementById(id)) {return;}
  //    js = d.createElement('script'); js.id = id; js.async = true;
  //    js.src = "//connect.facebook.net/en_US/all.js";
  //    ref.parentNode.insertBefore(js, ref);
  //  }(document));

    consoleFix();

function getFlashMovie(movieName) 
    {
        var isIE = navigator.appName.indexOf("Microsoft") != -1;
        return (isIE) ? window[movieName] : document[movieName];
    }

   
    function getMyId(){
       
       console.log("get my ID");
       document.getElementById("flashcontent").FBIDHandler("alex testing");


     //   FB.getLoginStatus(function(response) {  
     //    if (response.status === 'connected' && response.authResponse) {
     //        //console.log("response auth and connected :" +response.name);
     //        FB.api('/me', function(response) {
     //           document.getElementById("flashcontent").FBIDHandler(response);
     //  /*
     //           //var obj = swfobject.getObjectById("flashcontent");
     //           //obj.FBIDHandler(response);
     //           //onsole.log("response auth and connected :"+response);
      
     //           console.log('profile:id:'+response.id);
     //           console.log(response.name);
     //           console.log("response:"+response);
     // */
     //           for( var lues in response){
     //              var val = response[lues];
     //              console.log(lues +":"+val);
     //           }
     //         });    
     //    } else {
         
     //     console.warn('check popup');
     //     FB.login(function(response) {
     //       if (response.authResponse) {
     //         //console.log('Welcome!  Fetching your information.... ');
     //         FB.api('/me', function(response) {
     //           document.getElementById("flashcontent").FBIDHandler(response);
     //          //$("#facebook").hide(); 
     //         });
     //       } else {
     //          document.getElementById("flashcontent").FBIDHandler("Not Authorized");
     //        // console.log('User cancelled login or did not fully authorize.');
     //       }
     //      });
     //    }  
     //   });

    };


</script>



</body>


</html>

