package com.adamTensta.view
{
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	
	import flash.display.MovieClip;
	
	import com.greensock.TweenMax;
	
	public class EmptyTrackItem extends MovieClip
	{
		
		public var open_mc:MovieClip;	
		public var _model:Model;
		public var _var:Number;
		public var profiles_mc:MovieClip;
		
		public function EmptyTrackItem(val:Number = 1)
		{
			_model = Model.getInstance();
			 _var  = val;
			 
			profiles_mc.gotoAndStop(val);
			open_mc.visible=false;
			
			_model.addEventListener(ModelEvent.SHOW_TEST2,function(){
				_model.l("receiveshowtest2:val"+val);
				if(_var>1){
					TweenMax.to(profiles_mc,.5,{alpha:0.2,delay:val/10});
				}
			});
			_model.addEventListener(ModelEvent.SHOW_TESTEND,function(){
				_model.l("receiveshowtest2:val"+val);
					TweenMax.to(profiles_mc,.5,{alpha:0});
				
			});
		}
	}
}