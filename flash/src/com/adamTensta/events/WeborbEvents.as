package com.adamTensta.events
{
	import flash.events.Event;
	
	public class WeborbEvents extends Event
	{
		
		public static const RETURN_ROOMS	:String = "return rooms";
		public static const UNLOCK_TRACK	:String = "unlock track";	
		
			
			
		private var _vo:*;
		
		public function WeborbEvents(type:String, bubbles:Boolean=false, cancelable:Boolean=false, __vo:*=null)
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