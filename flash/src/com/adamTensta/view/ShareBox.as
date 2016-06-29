package com.adamTensta.view
{
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import flash.events.MouseEvent;
	
	import flash.display.MovieClip;
	import flash.display.SimpleButton;
	import flash.events.Event;
	import flash.text.TextField;
	
	public class ShareBox extends MovieClip
	{
		
		public var url_txt:TextField;
		public var close_btn:SimpleButton;
		
		private var _model:Model;
		
		public function ShareBox()
		{
			_model = Model.getInstance();
			addEventListener(Event.ADDED_TO_STAGE, added);
			
		}
		
		private function added(e:Event):void{
			close_btn.addEventListener(MouseEvent.CLICK, hideBox);
			url_txt.text = "http://prototypes.mingcompany.com/multitrack/index.php?id="+_model.ROOMID;	
		}
		
		private function hideBox(e:MouseEvent):void{
			_model.sendEvent(new ModelEvent(ModelEvent.CLOSE_SHAREBOX));
			_model.l("sharebox:Close");
		}
		
	}
}