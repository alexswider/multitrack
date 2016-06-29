<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>MULTI TRACK</title>

<script type="text/javascript" src="../js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="../js/util.js"></script>
<script src="http://prototypes.mingcompany.com:3010/socket.io/socket.io.js"></script>
  
<!--
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>

<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/swfforcesize.js"></script>
-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="../img/favicon.ico"/>



</head><body>
<!--
<div id="facebook">
  <a href="#" id="fb" onclick="auth_click()">Request this textbook</a></p>
</div>
-->
<object id="flashcontent" name="flashcontent" flashvars="roomID=<?php echo $_GET['id'];?>"
  type="application/x-shockwave-flash" data="main.swf?<?php echo rand(); ?>" width="100%" height="100%">
    <param name="movie" value="main.swf"/>
    <param name="quality" value="high"/>
    <param name='flashvars' value='roomID=<?php echo $_GET['id'];?>'/>
    <param name="allowscriptaccess" value="always"/>
    <a href="http://www.adobe.com/go/getflash">
        <img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player"/>
    </a>
  </object>
<div id="console">Console</div>
<div id="fb-root"></div>
<script>
  //swfobject.registerObject("flashcontent", "11", "expressInstall.swf");

 
  var socket = io();

  // Gets the 123 out of /room/123
  var room = 12;//<?php echo $_GET['id'];?>;
  console.log("room from path:"+room);
  var socket = io.connect("http://prototypes.mingcompany.com:3010");

    socket.on("connect", function(){
        //socket.emit('user_join', "Bob", room);
        console.log("connected");
    });

    socket.on("update_chat", function(username, message){
        console.log("update_chat");
        addChatMessage(username, message);
        messages.push({username : username, message : message});
    });

  function joinRoom(_user,_room){
    socket.emit('user_join', _user, _room);
  };

  function send(_val,_room){
    socket.emit('chat_message', _val,_room);
    room = _room;
  };

  function addChatMessage(username,message){
    $("message").html = username+":"+message;
  };

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '526582300794681', // App ID
      channelUrl : '//prototypes.mingcompany.com/multitrack/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML


    });
    console.log("fbInit")
    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

    consoleFix();

function getFlashMovie(movieName) 
    {
        var isIE = navigator.appName.indexOf("Microsoft") != -1;
        return (isIE) ? window[movieName] : document[movieName];
    }

   
    function getMyId(){
       
       console.log("get my ID");

       FB.getLoginStatus(function(response) {  
        if (response.status === 'connected' && response.authResponse) {
            //console.log("response auth and connected :" +response.name);
            FB.api('/me', function(response) {
               document.getElementById("flashcontent").FBIDHandler(response);
      /*
               //var obj = swfobject.getObjectById("flashcontent");
               //obj.FBIDHandler(response);
               //onsole.log("response auth and connected :"+response);
               console.log('profile:id:'+response.id);
               console.log(response.name);
               console.log("response:"+response);
     */
               for( var lues in response){
                  var val = response[lues];
                  console.log(lues +":"+val);
               }
             });    
        } else {
         
         console.warn('check popup');
         FB.login(function(response) {
           if (response.authResponse) {
             //console.log('Welcome!  Fetching your information.... ');
             FB.api('/me', function(response) {
               document.getElementById("flashcontent").FBIDHandler(response);
              //$("#facebook").hide(); 
             });
           } else {
              document.getElementById("flashcontent").FBIDHandler("Not Authorized");
            // console.log('User cancelled login or did not fully authorize.');
           }
          });
        }  
       });

    };


</script>



</body>


</html>

