package com.adamTensta.view
{
	
	//BUtton for adding tracks
	import com.adamTensta.commands.Model;
	import com.adamTensta.events.ModelEvent;
	import com.greensock.TweenMax;
	import com.greensock.easing.Expo;
	
	import flash.display.MovieClip;
	import flash.display.SimpleButton;
	import flash.display.Sprite;
	
	
	
	public class Intro extends Sprite
	{
		
		public var btn:MovieClip;
		public var artist_mc:MovieClip;
		public var artistTitle_mc:MovieClip;
		public var multitrack_mc:MovieClip;
		
		private var _model:Model;
		
		public var fb_mc:MovieClip;
		
		
		
		public function Intro()
		{
			_model = Model.getInstance();
			
			//super();
			btn.visible = false;
			fb_mc.alpha = 0;
			
			TweenMax.allFrom([artist_mc,artistTitle_mc,multitrack_mc],1,{autoAlpha:0,ease:Expo.easeOut,delay:1},1,nextF);
			
			
			//TweenMax.from(btn, 1, {delay:5,autoAlpha:0});
			
		}
		
		private function nextF():void{
			trace("nextF");
			TweenMax.allTo([artist_mc,artistTitle_mc,multitrack_mc],1,{delay:4,autoAlpha:0,ease:Expo.easeOut},0,done);
			
			
		}
		
		private function done():void{
			_model.dispatchEvent(new ModelEvent(ModelEvent.SHOW_TEST));
			TweenMax.delayedCall(3,next2);
		}
		
		private function next2():void{
			trace("next2");
			_model.dispatchEvent(new ModelEvent(ModelEvent.SHOW_TEST2));
			TweenMax.to(fb_mc, 2,{autoAlpha:1, ease:Expo.easeOut});
			TweenMax.delayedCall(2,next3);
		}
		
		private function next3():void{
			
			TweenMax.delayedCall(8,end);
		}
		
		private function end():void{
			_model.dispatchEvent(new ModelEvent(ModelEvent.SHOW_TESTEND));
			TweenMax.to(this, 1,{delay:.4,autoAlpha:0, ease:Expo.easeOut});
		}
	}
}