package com.adamTensta.commands
{
	import com.adamTensta.events.ModelEvent;
	import com.carlcalderon.arthropod.Debug;
	
	import flash.events.Event;
	import flash.events.EventDispatcher;
	import flash.events.IEventDispatcher;
	import flash.net.SharedObject;
	
	public class Model extends EventDispatcher
	{
		
		public  static var _instance:Model;
		private var _FBID:String ;
		private var _FB_NAME:String;
		private var _FB_AVATAR_PATH:String;
		
		private var _ROOMID:String = "none";
		
		private var _TOTAL_TRACKS:uint = 12;
		
		private var _StageWidth:Number;
		private var _StageHeight:Number;
		private var _shareObj:SharedObject;
		
		//private var currentTracks:Array = [["user name1","IP",'FBID','soundpathUrl'],[],[]]
		private var _currentTracks:Array = [	];
		
		private var _currentlyUnlocked:uint = 3;

		
		public function l(v:String):void{
			sendEvent(new ModelEvent(ModelEvent.TRACE, v));
			
		}
		
		public function Model(prv:PrivateClass){
			
		}
		
		public function get currentTracks():Array
		{
			return _currentTracks;
		}

		public function set currentTracks(value:Array):void
		{
			_currentTracks = value;
		}

		public function get TOTAL_TRACKS():uint
		{
			return _TOTAL_TRACKS;
		}

		public function set TOTAL_TRACKS(value:uint):void
		{
			_TOTAL_TRACKS = value;
		}

		public function get FB_NAME():String
		{
			return _FB_NAME;
		}

		public function set FB_NAME(value:String):void
		{
			_FB_NAME = value;
		}

		public function get FB_AVATAR_PATH():String
		{
			return _FB_AVATAR_PATH;
		}

		public function set FB_AVATAR_PATH(value:String):void
		{
			_FB_AVATAR_PATH = value;
		}

		public function get ROOMID():String
		{
			return _ROOMID;
		}

		public function set ROOMID(value:String):void
		{
			_ROOMID = value;
		}

		public  function get FBID():String
		{
			return _FBID;
		}

		public  function set FBID(value:String):void
		{
			_FBID = value;
		}

		public function get CurrentlyUnlocked():uint
		{
			return _currentlyUnlocked;
		}

		public function set CurrentlyUnlocked(value:uint):void
		{
			_currentlyUnlocked = value;
		}

	
		public  function get StageWidth():Number{
			return _StageWidth;
		}
		
		public  function set StageWidth(value:Number):void
		{
			_StageWidth = value;
			
		}
		
		public  function get StageHeight():Number
		{
			return _StageHeight;
		}
		
		public  function set StageHeight(value:Number):void
		{
			_StageHeight = value;
		}
		
		public static function getInstance():Model{
			if(_instance ==null){
				_instance = new Model(new PrivateClass());
				
			}
			return _instance;
		}
/*		
		public function lg(v:String):void{
			sendEvent(new ModelEvent(ModelEvent.TRACE,v));
		}
*/	
		public function sendEvent(e:Event):void{
			if(e.type != ModelEvent.LOADING_PROGRESS){
				Debug.log("Model:EventDispatched"+e.type);
			}
			
			dispatchEvent(e);
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