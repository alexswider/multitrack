package com.adamTensta.commands
{
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import com.carlcalderon.arthropod.Debug;
	
	import flash.events.EventDispatcher;
	import flash.events.IEventDispatcher;
	import flash.external.ExternalInterface;
	
	public class JSInterface extends EventDispatcher
	{
		
		private var _EInterface:JSInterface;
		private var _model:Model;
		
		private static var _instance:JSInterface;
		
		public function JSInterface(pvt:PrivateClass)
		{
			Debug.log("instanceSetofJSInterface", Constants.DEBUG_COLOR_JSINTERFACE);
			_model = Model.getInstance();
			addListener();
		}
		
		public static function getInstance():JSInterface{
			if(_instance == null){
				_instance = new JSInterface(new PrivateClass());
			}
			return _instance;
		}
		
		public function callExt(e:ModelEvent):void{
			_model.l("JSInterface:ModelEvent:"+e.type);
			if (ExternalInterface.available) {
				
				switch(e.type){
					case ModelEvent.INIT:
						//ExternalInterface.call("getMyId");
					break
					case ModelEvent.ROOM_RECEIVED:
						Debug.log("callExternal:joinRoom");
						ExternalInterface.call("join_room",_model.FB_NAME,_model.ROOMID);
					break
					case ModelEvent.ROOM_CREATED:
						Debug.log("callExternal:roomCreated");
						ExternalInterface.call("join_room",_model.FB_NAME,_model.ROOMID);
					break
					
					case ModelEvent.GET_FBID:
						//ExternalInterface.call("getMyId");
						//if(Constants.LOCAL){
							_model.FB_AVATAR_PATH = "local:"+ Math.random();
							_model.FB_NAME = "Localny stasiek"+String(Math.random());
							_model.FBID = String(Math.round(Math.random()*10000));
							_model.sendEvent(new ModelEvent(ModelEvent.RECEIVED_FBID, _model.FBID));
							
						//};
					break
				}
				
			}else{
				Debug.log("ExternalInterface:NotAvailible");
			}
		}
		
		public function addListener():void{
			ExternalInterface.addCallback("sendToActionScript", receivedFromJavaScript);
			ExternalInterface.addCallback("FBIDHandler", FBIDEventHandler);
			ExternalInterface.addCallback("JSInit",initHandler);
			ExternalInterface.addCallback("UserJoined", userJoined);
			ExternalInterface.addCallback("Userleft", userLeft);
			_model.addEventListener(ModelEvent.GET_FBID,callExt);
			_model.addEventListener(ModelEvent.ROOM_RECEIVED,callExt);
			_model.addEventListener(ModelEvent.ROOM_CREATED,callExt);
		}
		
		
		private function initHandler(value:*){
			_model.sendEvent(new ModelEvent(ModelEvent.INIT,value));
		}
		
		private function userJoined(value:*){
			_model.sendEvent(new ModelEvent(ModelEvent.USER_JOINED_JS,value));
			
		}
		private function userLeft(value:*){
			_model.sendEvent(new ModelEvent(ModelEvent.USER_LEFT_JS,value));
			
		}
		
		
		private function receivedFromJavaScript(value:*):void{
			_model.l("ExternalInterface:receivedFromJS:"+value);
			_model.sendEvent(new ModelEvent(ModelEvent.JS_RETURN_CALL, value));
			
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