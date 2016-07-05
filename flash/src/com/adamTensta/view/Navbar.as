package com.adamTensta.view
{
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import com.adamTensta.commands.Constants;
	
	import flash.display.MovieClip;
	import flash.display.Sprite;
	import flash.events.Event;
	import flash.text.TextField;
	
	public class Navbar extends Sprite
	{
		
		public var progress_bar:MovieClip ;
		public var output_txt:TextField;
		private var _model:Model;
		
		public function Navbar()
		{
			_model =Model.getInstance();
			_model.addEventListener(ModelEvent.TRACE, traceHandler);
			_model.addEventListener(ModelEvent.LOADING_PROGRESS, progressHandler);
			_model.addEventListener(ModelEvent.RESIZE_STAGE, resizeHandler);
			
			this.addEventListener(Event.ADDED_TO_STAGE, addedToStage);
		}
		
		private function progressHandler(e:ModelEvent){
			//_model.l("Navbar:progress:"+e.vo);
			progress_bar.visible = true;
			progress_bar.width = _model.StageWidth;
			progress_bar.scaleX = e.vo;
			if(e.vo ==1){progress_bar.visible = false};
			
		}
		
		
		private function traceHandler(e:ModelEvent):void{
			output_txt.appendText(e.vo+"\n");
			
			if(!Constants.DEBUG){output_txt.visible = false};
		}
		
		private function addedToStage(e:Event):void{
			progress_bar.width = _model.StageWidth;
			removeEventListener(Event.ADDED_TO_STAGE,addedToStage);
			progress_bar.x = progress_bar.y= 0;
			output_txt.x = _model.StageWidth - output_txt.width;
		
		}
		
		private function resizeHandler(e:ModelEvent):void{
			output_txt.x = _model.StageWidth - output_txt.width;
			progress_bar.width = _model.StageWidth;
			
			progress_bar.x = 0;
		}
		
		
	}
}