package com.adamTensta.events
{
	import flash.events.Event;
	
	public class ModelEvent extends Event
	{
		public static const RESIZE_STAGE:String 	= "Resize Stage";
		public static const RETURN_TRACKS:String 	= "RETURN TRACKS AS ARRAY";
		
		public static const LOADING_PROGRESS:String = "LOADING ASSETS";
		
		public static const INIT:String 			= "INIT";
		
		public static const CLOSE_SHAREBOX:String   = "CLOSE SHARE BOX";
		public static const SHOW_SHAREBOX:String   = "SHOW SHARE BOX";
		
		public static const JS_RETURN_CALL:String 	= "JS RETURN CALL";
		public static const GET_FBID:String 		= "GET FB ID CALL";
		public static const RECEIVED_FBID:String 	= "RECEIVED FB ID CALL";
		
		public static const TRACE:String 			= "TRACE";
		
		public static const JOIN_ROOM:String 		= "JOIN_ROOM";
		public static const USER_PULLED				= "CHECK IF I AM A HOST OR TRACK OWNER";
		
		
		public static const CREATE_ROOM:String 		= "CREATE_ROOM";
		public static const ROOM_CREATED:String 	= "CREATE room for user";
		public static const ROOM_EXPIRED:String 	= "ROOM EXPIRED EVENT";
		public static const ROOM_RECEIVED			= "ROOM LOADED IN WEBSERVICE";
		public static const ROOM_UPDATE				= "ROOM UPDATE";
		
		
		public static const SHOW_TEST				= "SHOWTEST";
		public static const SHOW_TEST2				= "SHOWTES2T";
		public static const SHOW_TESTEND				= "SHOWTEST END";
// JS NOde		
		
		public static const USER_JOINED_JS			= " USER JOINED JS";
		
		
///sound Events		
		public static const LOAD_SOUND:String 		= "load Sound";
			
		private var _vo:*;
		
		public function ModelEvent(type:String,__vo:*=null, bubbles:Boolean=false, cancelable:Boolean=false)
		{
			super(type, bubbles, cancelable);
			this._vo = __vo;	
			
			
			
		}
		
		
		public function get vo():* 
		{
			return _vo;
		}
		
	}
}