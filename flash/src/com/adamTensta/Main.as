
package com.adamTensta
{
	import com.adamTensta.commands.Constants;
	import com.adamTensta.commands.JSInterface;
	import com.adamTensta.commands.Model;
	import com.adamTensta.commands.WebService;
	import com.adamTensta.events.ModelEvent;
	import com.adamTensta.events.WeborbEvents;
	import com.adamTensta.view.*
	import com.carlcalderon.arthropod.Debug;
	
	
	import com.greensock.TweenMax;
	
	import flash.display.LoaderInfo;
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.display.Stage;
	import flash.display.StageAlign;
	import flash.display.StageScaleMode;
	import flash.events.Event;
	import flash.events.MouseEvent;
	import flash.system.Security;
	
	public class Main extends Sprite
	{
		private var _model:Model;
		private var _webOrb:WebService;
		private var _extJS:JSInterface;
		public var room:TracksList;
		public var intro:Intro;
		private var paramObj:Object;
		private var navbar:Navbar;
		
		public var roomExpired:RoomExpired;
		public var shareBox:ShareBox;
		
		public function Main()
		{
			//constructor
			
			Security.allowDomain("prototypes.justcallmealex.com");
			Debug.log("init");
			trace("init");
			_model = Model.getInstance();
			_webOrb = WebService.getInstance();
			_extJS = JSInterface.getInstance();
			addEventListener(Event.ADDED_TO_STAGE, addedToStageHandler);
			
		}

		protected function addedToStageHandler(event:Event):void
		{	
			removeEventListener(Event.ADDED_TO_STAGE, addedToStageHandler);
			stage.scaleMode 	= StageScaleMode.NO_SCALE;
			stage.align 		= StageAlign.TOP_LEFT;
			_model.StageHeight 	= stage.stageHeight;
			_model.StageWidth  	= stage.stageWidth;
			paramObj = LoaderInfo(this.root.loaderInfo).parameters;
			//if there is variable passed check for guid in database and display sample in record box		
			Debug.log("entrytest:"+paramObj.roomID,0xff00ff);
			if(paramObj.roomID)_model.ROOMID = paramObj.roomID;
			
			if(Constants.LOCAL){
				_model.ROOMID = "123";
			}else{
				//Constants._localBasePath = Constants._BasePath;
			}
			
			trace("roomID:"+_model.ROOMID);
			
	//addtrack btn for Dev		
			showBackground();
			
			intro = new Intro();
			addChild(intro);
			intro.x = _model.StageWidth/2 - intro.width/2 ;
			intro.y = _model.StageHeight/2 - intro.height/2 ;
			
			TweenMax.delayedCall(5,showTracks);
		}
		
		protected function showTracks():void{
			
			
			
			room = new TracksList();
			addChild(room);
			room.x = 0;
			room.y = _model.StageHeight;
			
			
			showNavbar();
			
			
			//addTrack.visible = false;
			addListeners();
		}

		
		
		private function addListeners(){
			stage.addEventListener(Event.RESIZE, resizeHandler);
			
			resizeHandler(new Event(""));
			_model.addEventListener(ModelEvent.RECEIVED_FBID, accessHandler);
			_model.addEventListener(ModelEvent.USER_PULLED, checkTrackStatus);
			_model.addEventListener(ModelEvent.ROOM_EXPIRED, roomExpiredHandler);
			_model.addEventListener(ModelEvent.CLOSE_SHAREBOX, shareBoxAction);
			_model.addEventListener(ModelEvent.SHOW_SHAREBOX, shareBoxAction);
			
			
//step 1 : authorize app			
			
			
			MovieClip(intro.getChildByName("btn")).addEventListener(MouseEvent.CLICK, getFBID);
		}
		
		private function shareBoxAction(e:ModelEvent):void{
			switch(e.type){
				case ModelEvent.CLOSE_SHAREBOX:
					Debug.log("close IT!!");
					shareBox.visible = false;
				break;
				case ModelEvent.SHOW_SHAREBOX:
					if(shareBox !=null){
						shareBox.visible = true;
						Debug.log("make it visible!");
					}else{
						Debug.log("add Share to stage");
						shareBox = new ShareBox();
						addChild(shareBox);
						shareBox.y = _model.StageHeight /2;
						shareBox.x = _model.StageWidth/2;
					}
				break
				
			}
		}
		
		
		private function roomExpiredHandler(e:ModelEvent):void{
			roomExpired = new RoomExpired();
			addChild(roomExpired);
			roomExpired.x = _model.StageWidth/2;
			roomExpired.y = _model.StageHeight/2;
			Debug.log("Main:roomExpired");
			MovieClip(roomExpired.getChildByName("btn")).addEventListener(MouseEvent.CLICK,resetRoom);
		}
		
		private function resetRoom(e:MouseEvent):void{
			roomExpired.visible = false;
			_model.ROOMID = "none";
			_model.sendEvent(new ModelEvent(ModelEvent.USER_PULLED));
		}
			
		private function getFBID(e:MouseEvent):void{
			_model.sendEvent(new ModelEvent(ModelEvent.GET_FBID));
			intro.visible = false;
		}

//step 2 : get authorization or just play 3 tracks		
		private function accessHandler(e:ModelEvent):void{
			trace("main:acceshandler:");
			trace("eventType:"+e.type);
			trace("e:VO:"+e.vo);
			trace("roomID"+_model.ROOMID);
			
			if(e.vo != "Not Authorized"){
				_webOrb.CheckCreateUser();
			}else{
				showTeaser();
			}
		}
		
		
		
		private function showTeaser():void{
			trace("show Teaser");
			_model.sendEvent(new ModelEvent(ModelEvent.TRACE,"SHOW TEASER"))
		}
		
//step 3 : check if I am a host	or joined a room already
		private function checkTrackStatus(e:ModelEvent):void{
			if(_model.ROOMID!="none"){
				_webOrb.joinRoom(_model.ROOMID);
			}else{
				trace('create Room');
				_webOrb.createRoom();
			}
		}
		
//step 4 : get room tracks 		
		private function init(e:ModelEvent=null):void{
			
		/* 
			if(room==null){
				room = new TracksList();
				addChild(room);
				room.x = 0;
				room.y = _model.StageHeight;
			}
		*/
		}
		
		private function clickHandler(e:MouseEvent):void{
			_model.dispatchEvent(new WeborbEvents(WeborbEvents.UNLOCK_TRACK));
		}

		private function showNavbar():void{
			navbar = new Navbar();
			addChild(navbar);
			navbar.x = 0;
			navbar.y = 0;
		}


		private function showBackground():void{
			var bg:Background = new Background();
			addChild(bg);			
		}

		private function resizeHandler(e:Event){
			_model.StageHeight = stage.stageHeight;
			_model.StageWidth  = stage.stageWidth;
			_model.sendEvent(new ModelEvent(ModelEvent.RESIZE_STAGE));
			
			if(room){
				room.x = 0;
				room.y = _model.StageHeight;
			}
		}


	}
}