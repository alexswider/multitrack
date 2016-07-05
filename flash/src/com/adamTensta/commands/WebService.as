package com.adamTensta.commands
{

	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import com.carlcalderon.arthropod.Debug;
	
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.IEventDispatcher;
	import flash.events.IOErrorEvent;
	import flash.events.NetStatusEvent;
	import flash.events.SecurityErrorEvent;
	import flash.net.NetConnection;
	import flash.net.Responder;
	import flash.net.URLLoader;
	import flash.net.URLRequest;

	public class WebService extends EventDispatcher
	{	

		private static var _instance:WebService;
		
		//webservice vars
		private var nameSpace:String = "ListenersService";
		private var _ncWebOrb:NetConnection;
		private var _model:Model;

		public function WebService(pvt:PrivateClass)
		{
			
			Debug.log("instanceSetofWebService", Constants.DEBUG_COLOR_WEBSERVICE);
			initWebOrb();
		}

		public static function getInstance():WebService{
			if(_instance == null){
				_instance = new WebService(new PrivateClass());
			}
			return _instance;
		}

		private function initWebOrb():void{	
			_model = Model.getInstance();
			
			_model.addEventListener(ModelEvent.USER_JOINED_JS, checkforUsers);
			
			///IMPORTANT  LOCAL TESTING		
			//button.text = "calling amf";
			_ncWebOrb = new NetConnection();
			if(Constants.LOCAL){
				_ncWebOrb.connect('http://prototypes.mingcompany.com/multitrack/qcubed/amfphp/gateway.php');
				Debug.log("initWbeOrb:Local:",Constants.DEBUG_COLOR_WEBSERVICE);
				
			}else{
				_ncWebOrb.connect('../qcubed/amfphp/gateway.php');
			}
			_ncWebOrb.addEventListener(NetStatusEvent.NET_STATUS, netStatusHandler);
			_ncWebOrb.addEventListener(SecurityErrorEvent.SECURITY_ERROR, securityErrorHandler);
		}

//user Service		
		public function CheckCreateUser():void{
			var webOrbResponder = new Responder(checkCreateUserResponder, OnErrorHandler);
			_model.l("WebOrb.checkUser"+_model.FBID);
			_ncWebOrb.call("Rooms.CheckCreateUser",webOrbResponder,_model.FBID,_model.FB_NAME,_model.FB_AVATAR_PATH);
		}
		
		
		public function createRoom():void{
			_model.l("webserwice:"+_model.FBID);
			var webOrbResponder = new Responder(createRoomResponder, OnErrorHandler);
			_ncWebOrb.call("Rooms.CreateRoom",webOrbResponder,_model.FBID);
		}
		
		public function joinRoom(__roomID:String):void{
			_model.ROOMID = __roomID;
			var webOrbResponder = new Responder(joinRoomResponder, OnErrorHandler);
			_model.l("amf:joinRoom:"+_model.FBID+","+__roomID+","+Constants.TOTAL_TRACKS+","+Constants.ROOM_EXPIRE);
			
			Debug.log("amf:joinRoom:"+[_model.FBID,__roomID,Constants.TOTAL_TRACKS,Constants.ROOM_EXPIRE], Constants.DEBUG_COLOR_WEBSERVICE);
			_ncWebOrb.call("Rooms.JoinByRoomID",webOrbResponder,_model.FBID,__roomID,Constants.TOTAL_TRACKS,Constants.ROOM_EXPIRE);
			
		}
		
		public function checkforUsers():void{
			var webOrbResponder = new Responder(CheckResponder, OnErrorHandler);
			Debug.log("amf:check:"+_model.currentTracks.length, Constants.DEBUG_COLOR_WEBSERVICE);
			_ncWebOrb.call("Rooms.checkForExtraTracks",webOrbResponder,_model.currentTracks.length,_model.ROOMID);
		}
		
////RESPONDERS
		
		private function CheckResponder(result:Object):void{
			Debug.log("amf:ChekResponder:"+result, Constants.DEBUG_COLOR_WEBSERVICE);
			_model.l("amf:ChekResponder:"+result);
			if(result){
				var i:uint = 0;
				while(i<result.length){
					var arr:Array = new Array();
					//FBId = "123" Name = "alex" Path = "" Tracks = "4"
					arr[0] = result[i].FBId;
					arr[1] = result[i].Name;
					arr[2] = result[i].Path;
					arr[3] = result[i].Tracks;
					_model.currentTracks.push(arr);
					i++
				}
				//_model.l("afteroomupdate:arr:"+_model.currentTracks);
				Debug.log("afteroomupdate:arr:"+_model.currentTracks, Constants.DEBUG_COLOR_WEBSERVICE);
				_model.sendEvent(new ModelEvent(ModelEvent.ROOM_UPDATE));
			}
		}
		
		private function checkCreateUserResponder(result:Object):void{
			Debug.log("amf:checkCreateUserResponder:"+result, Constants.DEBUG_COLOR_WEBSERVICE);
			_model.sendEvent(new ModelEvent(ModelEvent.USER_PULLED));
		}
	
		private function joinRoomResponder(result:*):void{
			Debug.log("amf:joinRoom Responder:"+result, Constants.DEBUG_COLOR_WEBSERVICE);
			_model.l("amf:joinRoom Responder:"+result);
			//FBId = "123" Name = "alex" Path = "" Tracks = "4"
			
			switch(result){
				case "EXPIRED":
					_model.sendEvent(new ModelEvent(ModelEvent.ROOM_EXPIRED));
				break;
				default:
					var i:uint = 0;
					while(i<result.length){
						var arr:Array = new Array();
						arr[0] = result[i].FBId;
						arr[1] = result[i].Name;
						arr[2] = result[i].Path;
						arr[3] = result[i].Tracks;
						_model.currentTracks.push(arr);
						i++
					}
					if(i<1)_model.ROOMID = "none tracks found";
					Debug.log("afteJoinRoom:arr:"+_model.currentTracks, Constants.DEBUG_COLOR_WEBSERVICE);
					_model.sendEvent(new ModelEvent(ModelEvent.ROOM_RECEIVED));
				 break;	
			}
			
			
		}
		
		private function createRoomResponder(result:Object):void{

			Debug.log("amf:createRoom Responder:"+result, Constants.DEBUG_COLOR_WEBSERVICE);
				_model.l("create room responder"+result);
				var i:uint = 0;
				while(i<result.length){
					var arr:Array = new Array();
					arr[0] = result[i].FBId;
					arr[1] = result[i].Name;
					arr[2] = result[i].Path;
					arr[3] = result[i].Tracks;
					arr[4] = result[i].RoomId;
					_model.currentTracks.push(arr);
					if(i==0)_model.ROOMID = result[i].RoomId;
					i++
				}
				Debug.log("WS:roomId:"+_model.ROOMID);
				_model.sendEvent(new ModelEvent(ModelEvent.ROOM_CREATED));
		}
		
		private function loadByIDResponder(result:Object):void{
			Debug.log("amf:LoadBy ID Responder:"+result, Constants.DEBUG_COLOR_WEBSERVICE);
			//_model.sendEvent(new SampleEvent(SampleEvent.WEBSERVICE_LOAD_BY_ID,result));
		}	

		private function OnErrorHandler(err:Object){
			Debug.log("OnErrorHandler() -> WebOrb Error!", Constants.DEBUG_COLOR_WEBSERVICE);
			for each(var prop in err){
				Debug.log("Error details: "+prop, Constants.DEBUG_COLOR_WEBSERVICE);
			}
		}		

		//-----------------------------------------------------------------------------------
		private function netStatusHandler(e:NetStatusEvent):void{
			if(e.info.code == "NetConnection.Call.Failed"){
				//	button.text =  "netStatusHandler: "+e.info.code;
			}else{
				//	button.text =  "netStatusHandler: "+e.info.code;
			}	
		}
		
		//-----------------------------------------------------------------------------------
		private function securityErrorHandler(e:SecurityErrorEvent):void{	
			Debug.error("##  : securityErrorHandler");
		}
	}

}
		//-----------------------------------------------------------------------------------
	// PRIVATE CLASS for Singleton
	//-----------------------------------------------------------------------------------
	class PrivateClass
	{
		public function PrivateClass()
		{
		}
	}