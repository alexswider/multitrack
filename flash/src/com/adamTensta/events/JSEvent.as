package com.adamTensta.events
{
	import flash.events.Event;
	import com.adamTensta.events;
	
	public class JSEvent extends Event
	{
		
		public static const FB_ID_RETURN	:String = "FB ID return";
		public static const UNLOCK_TRACK	:String = "unlock track";	
		
		
		
		private var _vo:*;
		
		public function JSEvent(type:String, bubbles:Boolean=false, cancelable:Boolean=false, __vo:*=null)
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


