
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<script type="text/javascript" src="js/util.js"></script>
<script type="text/javascript" src="js/swfforcesize.js"></script>
<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="img/favicon.ico"/>

<script type="text/javascript" src="js/swfobject.js"></script>


<script type="text/javascript">
    


    
</script>

</head><body onload="pageInit();">
<div id="facebook">
  <a href="#" id="fb" onclick="auth_click()">Request this textbook</a></p>
</div>
<div>
    <object id="flashcontent" name="flashcontent" flashvars="id=<?php echo $_GET['id'];?>" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%">

        <param name="movie" value="swf/main.swf" />
        <param name="allowScriptAccess=" value="always"/>
        <param name='flashvars' value='id=<?php echo $_GET['id'];?>'/>
        <!--[if !IE]>-->
        <object type="application/x-shockwave-flash" data="swf/main.swf" flashvars="id=<?php echo $_GET['id'];?>" width="100%" height="100%">
        <!--<![endif]-->
          <p>loading...</p>
          <p>     
          </p>
          <p>     
          
          You need at least Flash Player 11.0 to view this page.
          
          </p>
          
          <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
        <!--[if !IE]>-->
        </object> 
        <!--<![endif]-->
   </object>
    
    
</div>

<div id="fb-root"></div>
<script>
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
</script>
<script type="text/javascript">

consoleFix();


function FBIDHandlers(num) 
{
  console.warn('FBIDHandlers')
   var obj = swfobject.getObjectById("flashcontent");
        if (obj && typeof obj.FBIDHandler != "undefined") {
          console.warn('FBIDHandlers on object')
          obj.FBIDHandler(num);
        }
    
    

    // e.g. an external interface call
  //  getFlashMovie("flashcontent").FBIDHandler(num);
    //document.getElementById("flashcontent").FBIDHandler(num);
}




function getMyId(){
  FB.getLoginStatus(function(response) {  
    if (response.status === 'connected' && response.authResponse) {
        //console.log("response auth and connected :" +response.name);
        FB.api('/me', function(response) {
           FBIDHandlers(response);
           //onsole.log("response auth and connected :"+response);
           /*
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
     $("#facebook").show();
      $("#facebook").css("visibility","visible");
     $("#facebook").css("z-index",999);
     console.warn('asdads');

    }  
});


  //$( "#fb" ).trigger( "click" );

}

function auth_click() {
  FB.login(function(response) {
       if (response.authResponse) {
         //console.log('Welcome!  Fetching your information.... ');
         FB.api('/me', function(response) {
           FBIDHandlers(response);
          $("#facebook").hide(); 
         });
       } else {
         FBIDHandlers("Not Authorized");
        // console.log('User cancelled login or did not fully authorize.');
       }
      });
};

function postToWall(){
  // alert('test');


  FB.ui(
    {
     method: 'feed',
     message: 'facebook post to wall message ',
     name: 'facebook name',
     caption: 'caption here.',
        description: (
        'desctription! '+
        'end.'
     ),
     link: 'https://prototypes.mingcompany.com/multitrack',
     picture: 'http://prototypes.mingcompany.com/multitrack/img/thumbnail.png',
     actions: [
          { name: 'fbrell', link: 'https://prototypes.mingcompany.com/multitrack' }
     ],
    user_message_prompt: 'Share with Internet...'
    },
    function(response) {
      if (response && response.post_id) {
       // alert('Post was published.');
      } else {
       // alert('Post was not published.');
      }
    }
    
  );
        
 
   
      
}

function postToWallSubmit(guid,id){
  //alert('test');
  FB.ui(
    {
     method: 'feed',
     message: ' ',
     name: ' ',
     caption: '.',
        description: (
        ''
     ),
     link: 'https://prototypes.mingcompany.com/multitrack/index.php?id='+id,
     picture: 'http://prototypes.mingcompany.com/multitrack/'+guid+'/avatar.jpg',
     actions: [
          { name: 'listen', link: 'https://prototypes.mingcompany.com/multitrack/index.php?id='+id }
     ],
     properties: [
    { text: 'Listen', href:'https://prototypes.mingcompany.com/multitrack/index.php?id='+id}
     ],
    user_message_prompt: 'Share with your friends...'
    },
    function(response) {
      if (response && response.post_id) {
        //alert('Post was published.');
      } else {
      //  alert('Post was not published.');
        
      }
    }
  );
}
</script>
 
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36132840-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>


</html>

